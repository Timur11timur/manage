<?php

namespace Tests\Feature\Admin;

use App\Channel;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ChannelAdministrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_administrator_can_access_the_channel_administration_section()
    {
        $this->signInAdmin();

        $response = $this->get(route('admin.channels.index'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function non_administrators_cannot_access_the_channel_administration_section()
    {
        $regularUser = factory(User::class)->create();

        $this->actingAs($regularUser)
            ->get(route('admin.channels.index'))
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->actingAs($regularUser)
            ->get(route('admin.channels.create'))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function an_administrator_can_create_a_channel()
    {
        $response = $this->createChannel([
            'name' => 'php',
            'description' => 'This is the channel for discussing all things PHP.',
        ]);

        $this->get($response->headers->get('Location'))
            ->assertSee('php')
            ->assertSee('This is the channel for discussing all things PHP.');
    }

    /** @test */
    public function an_administrator_can_edit_an_existing_channel()
    {
        $this->withoutExceptionHandling();

        $this->signInAdmin();

        $channel = create('App\Channel');

        $updated_data = [
            'name' => 'altered',
            'description' => 'altered channel description',
            'archived' => false,
        ];

        $this->patch(
            route('admin.channels.update', ['channel' => $channel->slug]),
            $updated_data
        );

        $this->get(route('admin.channels.index'))
            ->assertSee($updated_data['name'])
            ->assertSee($updated_data['description']);
    }

    /** @test */
    public function an_administrator_can_mark_an_existing_channel_as_archived()
    {
        $this->signInAdmin();

        $channel = create('App\Channel');

        $this->assertFalse($channel->fresh()->archived);

        $updated_data = [
            'name' => 'altered',
            'description' => 'altered channel description',
            'archived' => true
        ];

        $this->patch(
            route('admin.channels.update', ['channel' => $channel->slug]),
            $updated_data
        );

        $this->assertTrue($channel->fresh()->archived);
    }

    /** @test */
    public function archived_channels_should_not_influence_existing_thread()
    {
        $channel = create('App\Channel');

        $thread = factory(Thread::class)->create(['channel_id' => $channel->id]);

        $path = $thread->path();

        $channel->update([
            'archived' => true
        ]);

        $this->assertEquals($path, $thread->fresh()->path());
    }

    /** @test */
    public function a_channel_requires_a_name()
    {
        $this->createChannel(['name' => null])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_channel_requires_a_description()
    {
        $this->createChannel(['description' => null])
            ->assertSessionHasErrors('description');
    }

    private function createChannel($overrides = [])
    {
        $this->signInAdmin();

        $channel = factory(Channel::class)->make($overrides);

        return $this->post(route('admin.channels.store'), $channel->toArray());
    }
}
