<?php

namespace Tests\Unit;

use Hash;
use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Str;
use App\Livewire\Users\UserCreate;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;

class UserCreateTest extends TestCase
{

    /** @test */
    public function user_creation()
    {
        $userId = (string) Str::orderedUuid();
        $faker = Factory::create();

        Livewire::test(UserCreate::class)
            ->set('userId', $userId)
            ->set('name', $faker->name())
            ->set('email', $faker->email())
            ->set('password', $faker->password())
            ->call('createUser');

        $this->assertDatabaseHas('users', [
            'name' => $faker->name(),
            'email' => $faker->email(),
        ]);
    }
}