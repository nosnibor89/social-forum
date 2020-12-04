<?php

namespace App\Models;

use App\Filters\ThreadsFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $withCount = ['replies'];

    public function getPaginatedRepliesAttribute()
    {
        return $this->replies()->paginate(3);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * @param array $reply
     */
    public function addReply(array $reply)
    {
        $this->replies()->create($reply);
    }

    /**
     * @return string
     */
    public function path()
    {
        return route('threads.show', ['thread' => $this, 'channel' => $this->channel->slug]);
    }

    public function scopeFilter($query, ThreadsFilters $filters)
    {
        return $filters->apply($query);
    }
}
