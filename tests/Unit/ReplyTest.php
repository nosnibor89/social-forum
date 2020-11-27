<?php

namespace Tests\Unit;

use App\Models\Favorite;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\TestUser;

class ReplyTest extends TestCase
{
    use RefreshDatabase, TestUser;

    /** @test */
    public function it_has_an_owner()
    {
        $reply = Reply::factory()->create();
        $this->assertInstanceOf(User::class, $reply->owner);
    }

    /** @test */
    public function it_can_have_favorites()
    {
        $user = $this->user();
        $reply = Reply::factory()->create();
        $reply->markAsFavoriteFor($user);

        $this->assertInstanceOf(Collection::class, $reply->favorites);
        $this->assertInstanceOf(Favorite::class, $reply->favorites->first());
    }
}
