<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_thread_requires_a_title_and_body_to_be_updated()
    {
        $this->signIn();

        $thread = factory(Thread::class)->create(['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'title' => 'Changed',
        ])->assertSessionHasErrors('body');

        $this->patch($thread->path(), [
            'body' => 'Changed body.',
        ])->assertSessionHasErrors('title');
    }

    /** @test */
    public function unauthorized_users_may_not_update_threads()
    {
        $this->signIn();

        $thread = factory(Thread::class)->create(['user_id' => factory(User::class)->create()->id]);

        $this->patch($thread->path(), [])->assertStatus(403);
    }

    /** @test */
    public function a_thread_can_be_updated_by_its_creator()
    {
        $this->signIn();

        $thread = factory(Thread::class)->create(['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'title' => 'Changed',
            'body' => 'Changed body.'
        ]);

        $thread = $thread->fresh();

        $this->assertEquals('Changed', $thread->title);
        $this->assertEquals('Changed body.', $thread->body);
    }
}
