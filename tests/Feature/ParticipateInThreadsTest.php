<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParticipateInThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {
        $this->post( '/threads/some-channel/1/replies', [])
            ->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $thread = factory(Thread::class)->create();

        $reply = factory(Reply::class)->make();

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->assertDatabaseHas('replies', ['body' => $reply->body]);
        $this->assertEquals(1, $thread->fresh()->replies_count);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->signIn();

        $thread = factory(Thread::class)->create();

        $reply = factory(Reply::class)->make(['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())->assertStatus(302);
        $this->json('post', $thread->path() . '/replies', $reply->toArray())->assertStatus(422);
    }

    /** @test */
    public function unauthorized_users_cannot_delete_replies()
    {
        $reply = factory(Reply::class)->create();

        $this->delete("/replies/{$reply->id}")
            ->assertRedirect('login');

        $this->signIn();

        $this->delete("/replies/{$reply->id}")
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_delete_replies()
    {
        $this->signIn();

        $reply = factory(Reply::class)->create(['user_id' => auth()->user()->id]);

        $this->delete("/replies/{$reply->id}")->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertEquals(0, $reply->thread->fresh()->replies_count);
    }

    /** @test */
    public function unauthorized_users_cannot_update_replies()
    {
        $reply = factory(Reply::class)->create();

        $this->patch("/replies/{$reply->id}")
            ->assertRedirect('login');

        $this->signIn();

        $this->patch("/replies/{$reply->id}")
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_update_replies()
    {
        $this->signIn();

        $reply = factory(Reply::class)->create(['user_id' => auth()->user()->id]);

        $updatedReply = 'You have been changed';

        $this->patch("/replies/{$reply->id}", ['body' => $updatedReply]);

        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => $updatedReply]);
    }

    /** @test */
    public function replies_that_contains_spam_may_not_be_created()
    {
        $this->signIn();

        $thread = factory(Thread::class)->create();

        $reply = factory(Reply::class)->make(['body' => 'Yahoo Customer Support']);

        $this->json('post', $thread->path() . '/replies', $reply->toArray())->assertStatus(422);
    }

    /** @test */
    public function users_may_only_reply_a_maximum_of_once_per_minute()
    {
        $this->signIn();

        $thread = factory(Thread::class)->create();

        $reply = factory(Reply::class)->make(['body' => 'My simple reply']);

         $this->post($thread->path() . '/replies', $reply->toArray())->assertStatus(201);

        $this->post($thread->path() . '/replies', $reply->toArray())->assertStatus(429);
    }
}
