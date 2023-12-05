<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_post_can_have_many_tags()
    {
        $post = Post::factory()->create();

        $tags = [];
        for($i=0;$i<3;$i++){
            $tags[] = Tag::factory()->create();
            $post->tags()->attach($tags[$i]);
        }

        foreach ($tags as $tag){
            $this->assertCount(3, $post->tags);
            $this->assertCount(1, $tag->posts);
            $this->assertTrue($post->tags->contains($tag->id));
            $this->assertTrue($tag->posts->contains($post->id));
        }
    }

    /** @test */
    public function a_tag_can_have_many_posts()
    {
        $tag = Tag::factory()->create();

        $posts = [];
        for($i=0;$i<3;$i++){
            $posts[] = Post::factory()->create();
            $tag->posts()->attach($posts[$i]);
        }

        foreach ($posts as $post){
            $this->assertCount(3, $tag->posts);
            $this->assertCount(1, $post->tags);
            $this->assertTrue($post->tags->contains($tag->id));
            $this->assertTrue($tag->posts->contains($post->id));
        }
    }

//    /** @test */
//    public function a_user_can_have_many_tags_from_posts()
//    {
//        $user = User::factory()->create();
//        for ($i=0;$i<3;$i++){
//            $tag = Tag::factory()->create();
//            for ($i=0;$i<3;$i++){
//                $post = Post::factory()->create(['user_id' => $user->id]);
//                $post->tags()->attach($tag);
//            }
//        }
//
//        $this->assertCount(3, $user->tags);
//    }
}
