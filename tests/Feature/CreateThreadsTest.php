<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\TestUser;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase, TestUser;

    /**
     * @test
     */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $channel = Channel::factory()->create();
        $thread = Thread::factory()->make(['channel_id' => $channel->id]);

        $this->publishAThread($thread->toArray());

        $recentThread = Thread::latest()->first();

        $this->get($recentThread->path())
            ->assertSee($thread['title'])
            ->assertSee($thread['body']);

    }

    /**
     * @test
     */
    public function a_guest_user_cannot_create_new_forum_threads()
    {
        $thread = Thread::factory()->make();
        $this->post(route('threads.store'), $thread->toArray())
            ->assertRedirect(route('login'));

        $this->get(route('threads.create'))
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function a_thread_requires_a_title()
    {
        $this->publishAThread(['title' => null])->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function a_thread_requires_a_valid_channel()
    {
        $this->publishAThread(['channel_id' => null])->assertSessionHasErrors('channel_id');

        $lastChannel = Channel::factory()->create();
        $nonExistingChannelId = $lastChannel->id + 10;
        $this->publishAThread(['channel_id' => $nonExistingChannelId])->assertSessionHasErrors('channel_id');
    }

    /**
     * @param array $attrs
     * @return TestResponse
     */
    private function publishAThread($attrs = []): TestResponse
    {
        $thread = Thread::factory()->make($attrs);
        return $this->signIn()->post(route('threads.store'), $thread->toArray());
    }
}
