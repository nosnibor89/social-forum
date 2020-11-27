<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\TestUser;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase, TestUser;

    /**
     * @test
     */
    public function an_authenticated_user_can_participate_in_forum_thread()
    {
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->make();

        $this->signIn()->post(route('threads.replies.store', $thread), $reply->toArray());


        $this->signIn()->get($thread->path())
            ->assertSee($reply->body);
    }

    /**
     * @test
     */
    public function unauthenticated_user_cannot_add_replies_in_forum_thread()
    {
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->make();

        $this->post(route('threads.replies.store', $thread), $reply->toArray())
            ->assertRedirect(route('login'));

    }

    /**
     * @test
     */
    public function a_reply_requires_a_body()
    {
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->make(['body' => null]);

        $this->signIn();
        $this->post(route('threads.replies.store', $thread), $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    private function postAReply(): TestResponse
    {
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->make();
        $this->signIn();
        return $this->post(route('threads.replies.store', $thread), $reply->toArray());
    }
}
