<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_can_have_a_subscription()
    {
        $subscription = Subscription::factory()->create();

        $user = User::factory()->create(['subscription_id' => $subscription->id]);

        $this->assertTrue($user->subscription->id === $subscription->id);
        $this->assertTrue($subscription->users->contains($user->id));
    }

    /** @test */
    public function a_subscription_can_have_many_users()
    {
        $subscription = Subscription::factory()->create();

        $user = User::factory(3)->create(['subscription_id' => $subscription->id]);

        $this->assertCount(3, $subscription->users);
    }

    /** @test */
    public function a_subscription_can_have_many_posts()
    {
        $subscription = Subscription::factory()->create();
        $user = User::factory()->create(['subscription_id' => $subscription->id]);
        $posts = Post::factory(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $subscription->posts);
        foreach ($posts as $post){
            $this->assertTrue($subscription->posts->contains($post->id));
        }
    }
}
