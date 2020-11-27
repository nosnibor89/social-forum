<?php


namespace Tests\Traits;


use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithAuthentication;

trait TestUser
{
    /**
     * @return User
     */
    private function user()
    {
        return tap(User::factory()->create(), function ($user) {
            Team::factory()->create(['user_id' => $user->id]);
        });
    }

    /**
     * @param null $as
     * @return $this
     */
    private function signIn($as = null)
    {
        $this->actingAs($as ?? $this->user());
        return $this;
    }


}
