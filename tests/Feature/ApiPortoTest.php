<?php

namespace Tests\Feature;

use App\Models\Porto;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiPortoTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_list_porto(): void
    {
        $response = $this->getJson('/api/list-porto');
        
        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->hasAll(['data','message'])
                    ->whereAllType(['data' => 'array','message' => 'string'])
        );
    }

    public function test_list_porto_exists():void
    {
        $this->seed(UserSeeder::class);
        Porto::create([
            'title' => 'coba',
            'short_desc' => 'short desc',
            'description' => 'description',
            'photo' => 'Photo',
            'link' => 'links',
            'user_id' => 1,
        ]);
        $response = $this->getJson('/api/list-porto');

        $this->assertDatabaseCount('portos', 1);
        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->hasAll(['data','message'])
                    ->whereAllType(['data' => 'array','message' => 'string'])
        );
    }

    
}
