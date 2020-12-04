<?php


namespace App\Models\Traits;


use App\Models\Favorite;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait Likeable
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'likeable');
    }

    /**
     * @param User $user
     * @return Model
     */
    public function markAsFavoriteFor(User $user)
    {
        return $this->favorites()->create([
            'user_id' => $user->id,
        ]);
    }
}
