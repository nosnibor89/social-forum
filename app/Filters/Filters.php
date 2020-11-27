<?php


namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $filters = [];

    /**
     * @var Request
     */
    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->filters as $filter) {
            if (method_exists($this, $filter)) {
                $this->$filter();
            }
        }

        return $this->builder;
    }
}
