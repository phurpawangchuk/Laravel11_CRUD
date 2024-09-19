<?php
// tests/Unit/PostTest.php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase; // Use this to rollback database changes after each test

    /** @test */
    public function it_can_create_a_post()
    {
        // Create a new post using the factory
        $post = Post::factory()->create();

        // Assert the post exists in the database
        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'description' => $post->description,
        ]);
    }

    /** @test */
    public function it_can_update_a_post()
    {
        // Create a new post
        $post = Post::factory()->create();

        // Update the post
        $post->update([
            'title' => 'Updated Title',
        ]);

        // Assert the post was updated
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
        ]);
    }

    /** @test */
    public function it_can_delete_a_post()
    {
        // Create a new post
        $post = Post::factory()->create();

        // Delete the post
        $post->delete();

        // Assert the post was deleted
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }
}