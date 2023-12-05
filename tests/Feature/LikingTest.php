<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikingTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_post_can_be_liked()
    {
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $post->likes()->attach($user);

        $this->assertCount(1, $post->likes);
        $this->assertCount(1, $user->liked_posts);
        $this->assertTrue($post->likes->contains($user->id));
    }

    /** @test */
    public function a_tag_can_be_liked()
    {
        $tag = Tag::factory()->create();
        $user = User::factory()->create();

        $tag->likes()->attach($user);

        $this->assertCount(1, $tag->likes);
        $this->assertCount(1, $user->liked_tags);
        $this->assertTrue($tag->likes->contains($user->id));
    }
}
