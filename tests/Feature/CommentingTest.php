<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentingTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_post_can_be_commented()
    {
        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'commentable_type' => Post::class,
            'commentable_id' => $post->id
        ]);

        $this->assertCount(1, $post->comments);
        $this->assertTrue($comment->commentable->id === $post->id
        && $comment->commentable_type === Post::class);
    }

    /** @test */
    public function a_tag_can_be_commented()
    {
        $tag = Tag::factory()->create();
        $comment = Comment::factory()->create([
            'commentable_type' => Tag::class,
            'commentable_id' => $tag->id
        ]);

        $this->assertCount(1, $tag->comments);
        $this->assertTrue($comment->commentable->id === $tag->id
            && $comment->commentable_type === Tag::class);
    }
}
