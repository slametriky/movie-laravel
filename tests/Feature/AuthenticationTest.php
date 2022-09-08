<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @group auth
     */
    public function it_can_access_login_page(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @group auth
     */
    public function it_can_access_register_page(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @group auth
     */
    public function user_can_login(): void
    {
        $email = rand(12345,678910).'test@gmail.com';
        $password = 'password';
        // Creating Users
        $user = User::create([
            'name' => 'test',
            'email' => $email,
            'password' => \Hash::make($password)
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ])            
            ->assertRedirect(route('categories.index'));

        // Delete users
        User::where('email',$email)->delete();
    }

    /**
     * @test
     * @group auth
     */
    public function failed_login_user_if_not_registered(): void
    {
        $email = rand(12345,678910).'test@gmail.com';
        $password = 'password';

        $this->post(route('login'), [
            'email' => $email,
            'password' => $password,
        ])
            ->assertRedirect(route('login'));

    }
}
