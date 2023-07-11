<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    /**
     * Failed Validation Login
     */
    public function test_login_validation_failed(): void
    {
        $response = $this->postJson('/api/login');

        $response->assertStatus(400)
            ->assertJson(fn (AssertableJson $json) => 
            $json->has('error')
                ->whereType('error', 'string')
        );
    }

    /**
     * Success Login
     */
    public function test_success_login():void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'admin@admin.com',
            'password' => 'superadmin123'
        ]);

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => 
            $json->hasAll(['access_token', 'token_type', 'expires_in'])
                ->whereAllType([
                    'access_token' => 'string',
                    'token_type' => 'string',
                    'expires_in' => 'string',
                ])
        );
    }

    /**
     * UnAuthorized Login
     */

     public function test_unauthorized_login():void
     {
        
     }
}
