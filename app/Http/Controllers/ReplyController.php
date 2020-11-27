<?php

namespace App\Http\Controllers;

use App\Models\Thread;

class ReplyController extends BaseForumController
{
    public function store(Thread $thread)
    {
        $validated = request()->validate([
            'body' => 'required'
        ]);

        $validated['user_id'] = auth()->id();

        $thread->addReply($validated);

        return back();
    }
}
