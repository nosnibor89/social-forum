<?php

namespace Tests\Unit;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\TestUser;


class UserTest extends TestCase
{
    use RefreshDatabase, TestUser;

    /**
     * @test
     */
    public function a_user_can_start_a_thread()
    {
        $thread = Thread::factory()->raw();
        $user = $this->user();
        $currentThreads = $user->threads()->count();
        $newThread = $user->startThread($thread);

        $this->assertEquals($user->threads()->count(), $currentThreads + 1);
        $this->assertTrue($user->threads()->latest()->first()->is($newThread));
    }
}
