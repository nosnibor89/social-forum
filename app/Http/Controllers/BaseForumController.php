<?php

namespace App\Http\Controllers;

class BaseForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('create', 'store');
    }
}
