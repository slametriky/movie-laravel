<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
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
     * @group categories
     */
    public function guest_cannot_access_category_page(): void
    {
        $this->get(route('categories.index'))
            ->assertStatus(302)            
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @group categories
     */
    public function authenticated_user_can_access_category_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('categories.index'))
            ->assertStatus(200)            
            ->assertSee('Master Kategori');

        $this->deleteUser($user->email);
    }

    /**
     * @test
     * @group categories
     */
    public function it_can_store_category(): void
    {
        $user = User::factory()->create();
        $request = Category::factory()->make();

        $this->actingAs($user)
            ->json('post', route('categories.store'), $request->toArray())
            ->assertOk()
            ->assertJsonFragment([
                'message' => 'success',
            ]);

        $this->assertDatabaseHas('categories', [
            'name' => $request->name,
            'api' => $request->api,
        ]);

        $this->deleteUser($user->email);
    }

    /**
     * @test
     * @group categories
     */
    public function it_can_delete_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $this->actingAs($user)
            ->json('delete', route('categories.destroy', $category))
            ->assertOk()
            ->assertJsonFragment([
                'message' => 'success',
            ]);

        $this->assertDatabaseMissing('categories', [
            'name' => $category->name,
            'api' => $category->api,
        ]);

        $this->deleteUser($user->email);
    }

    
    public function deleteUser($email)
    {
        User::where('email',$email)->delete();
    }
}
