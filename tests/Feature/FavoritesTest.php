<?php

namespace Tests\Feature;

use App\Models\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\Traits\TestUser;

class FavoritesTest extends TestCase
{
    use RefreshDatabase, TestUser;

    /**
     * @test
     */
    public function unauthenticated_user_cannot_mark_any_reply_as_favorite()
    {
        $reply = Reply::factory()->create();
        $this->post(route('replies.favorites.store', $reply))
            ->assertRedirect(route('login'));
    }


    /**
     * @test
     */
    public function a_user_can_mark_any_reply_as_favorite()
    {
        $this->signIn();
        $reply = Reply::factory()->create();
        $this->post(route('replies.favorites.store', $reply))->assertCreated();

        $this->assertCount(1, $reply->favorites);
    }

    /**
     * @test
     */
    public function a_user_cannot_mark_a_reply_as_favorite_more_than_one()
    {
        $user = $this->user();
        $this->signIn($user);

        $reply = Reply::factory()->create();
        $this->post(route('replies.favorites.store', $reply))->assertCreated();
        $this->post(route('replies.favorites.store', $reply))
            ->assertStatus(Response::HTTP_BAD_REQUEST);

        $this->assertCount(1, $reply->favorites);
    }
}
