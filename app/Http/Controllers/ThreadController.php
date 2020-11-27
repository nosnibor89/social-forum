<?php

namespace App\Http\Controllers;

use App\Filters\ThreadsFilters;
use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThreadController extends BaseForumController
{
    /**
     * Display a listing of the resource.
     *
     * @param Channel $channel
     * @param ThreadsFilters $filters
     * @return \Inertia\Response
     */
    public function index(Channel $channel, ThreadsFilters $filters)
    {

        $threadsQuery = $channel->exists ? $channel->threads()->withCount('replies')->latest() : Thread::withCount('replies')->latest();


        $threads = $threadsQuery->filter($filters)->get();

        if (request()->hasHeader('test-json')) {
            return $threads;
        }

//        return $threads;

        return Inertia::render('Threads/Index', compact('threads'));
//        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Threads/Edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'channel_id' => 'required|exists:channels,id',
            'body' => 'nullable'
        ]);

        $thread = auth()->user()->startThread($validated);

        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param $channelId
     * @param \App\Models\Thread $thread
     * @return \Inertia\Response
     */
    public function show($channelId, Thread $thread)
    {
//        return $thread->append('paginatedReplies')->load('creator');
        $thread->append('paginatedReplies')->load('creator');
        return Inertia::render('Threads/Show', compact('thread', 'channelId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
