<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\TestUser;

class ProfilesTest extends TestCase
{
    use RefreshDatabase, TestUser;

    /**
     * @test
     */
    public function authenticated_has_a_profile()
    {
        $user = $this->user();
        $this->get(route('public-profiles.show', $user))
            ->assertSee($user->name);

    }

    /**
     * @test
     */
    public function profiles_display_all_threads_of_a_given_user()
    {
        $user = $this->user();
        $threads = Thread::factory()->count(3)->create(['user_id' => $user->id]);
        $response = $this->get(route('public-profiles.show', $user));

        $threads->each(function ($thread) use ($response) {
           $response->assertSee($thread->title);
           $response->assertSee($thread->body);
        });
    }
}
