<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Http\Request;

class ThreadsFilters extends Filters
{
    protected $filters = ['by', 'popularity'];

    /**
     * @var User
     */
    private $user;

    public function __construct(Request $request, User $user)
    {
        parent::__construct($request);
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function by()
    {
        if ($username = $this->request->get('by')) {
            $user = $this->user->where('name', $username)->firstOrFail();
            $this->builder->where('user_id', $user->id);
        }
    }

    /**
     * @return mixed
     */
    public function popularity()
    {
        if ($username = $this->request->get('popularity')) {
            $this->builder->reorder('replies_count', 'desc');
        }
    }
}
