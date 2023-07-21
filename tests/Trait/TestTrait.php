<?php
namespace Tests\Trait;

use App\Models\User;

trait TestTrait
{
    public function getUser(){
        return User::where('email', 'admin@admin.com')->first();
    }
}
