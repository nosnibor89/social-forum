<?php

namespace Tests\Unit;

use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_channel_can_have_threads()
    {
        $channel = Channel::factory()->create();
        $threads = Thread::factory()->create(['channel_id' => $channel->id]);

        $this->assertCount($threads->count(), $channel->threads);
        $this->assertContainsOnlyInstancesOf(Thread::class, $channel->threads);
    }
}
