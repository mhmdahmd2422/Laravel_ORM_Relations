<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_can_create_a_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->assertCount(1, $user->posts);
        $this->assertTrue($post->user->id === $user->id);
        $this->assertTrue($user->posts->contains($post->id));
    }

    /** @test */
    public function a_user_can_create_many_posts()
    {
        $user = User::factory()->create();
        $post = Post::factory(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->posts);
        foreach ($user->posts as $post){
            $this->assertTrue($post->user->id === $user->id);
            $this->assertTrue($user->posts->contains($post->id));
        }
    }
}
