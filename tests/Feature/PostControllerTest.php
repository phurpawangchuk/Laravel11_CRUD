<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_create_a_post()
    {
        // Create a user and authenticate them
        $user = User::factory()->create();
        $this->actingAs($user);

        // Post data
        $postData = [
            'title' => 'Test Post',
            'description' => 'This is a test description',
            'image' => 'test-image.jpg', // assuming you're handling images correctly
        ];

        // Make a POST request to store the post
        $response = $this->post('/posts', $postData);

        // Assert the post exists in the database
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
        ]);

        // Assert the user is redirected after creation
        $response->assertRedirect('/posts');
    }

    /** @test */
    public function it_requires_authentication_to_create_a_post()
    {
        // Post data without authentication
        $postData = [
            'title' => 'Test Post',
            'description' => 'This is a test description',
        ];

        // Make a POST request to store the post
        $response = $this->post('/posts', $postData);

        // Assert the user is redirected to login
        $response->assertRedirect('/login');
    }

    /** @test */
    public function it_requires_a_title_to_create_a_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/posts', [
            'title' => '', // empty title
            'description' => 'This is a test description',
        ]);

        // Assert that validation fails
        $response->assertSessionHasErrors('title');
    }
}