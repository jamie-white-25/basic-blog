<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_posts_page_displays(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/posts');

        $response->assertOk();
    }

    /**
     * User can create a post
     */
    public function test_user_can_create_post(): void
    {
        $user = User::factory()->create();

        Storage::fake('public');

        $file = UploadedFile::fake()->image('blog.jpg');

        $response = $this
            ->actingAs($user, 'web')
            ->post('/posts', [
                'title' => 'body',
                'body' => 'title',
                'post_id' => 1,
                'file' => $file
            ]);

        $response->assertRedirect('/posts');
        $this->assertDatabaseCount('posts', 1);
        $this->assertDatabaseHas('posts', [
            'title' => 'body',
            'body' => 'title',
        ]);
    }

    /**
     * User can create a post
     */
    public function test_post_validation(): void
    {
        $user = User::factory()->create();

        Storage::fake('public');

        $file = UploadedFile::fake()->image('blog.jpg');

        $response = $this
            ->actingAs($user, 'web')
            ->post('/posts', [
                'title' => '',
                'body' => '',
                'post_id' => 0,
                'file' => $file
            ]);

        $response->assertSessionHasErrors(['title', 'body', 'slug']);
        $this->assertDatabaseCount('posts', 0);
    }

    /**
     * A basic feature test example.
     */
    public function test_only_authenticated_users_can_create_post(): void
    {
        $response = $this
            ->post('/posts', [
                'title' => 'body',
                'body' => 'title',
                'post_id' => 1
            ]);

        $response->assertForbidden();
    }
}
