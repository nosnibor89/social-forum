<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicProfilesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return Inertia::render('PublicProfiles/Show',
            [
                'profileUser' => $user,
                'paginatedThreads' => $user->threads()->latest()->paginate(30)
            ]
        );
    }
}
