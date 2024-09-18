<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Database\Eloquent\Builder;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function paginate($modelOrBuilder, $page_size = 20)
    {
        if (get_class($modelOrBuilder) != Builder::class)
            $result = $modelOrBuilder->newQuery();
        else
            $result = $modelOrBuilder;

        return $result->paginate($page_size)->withQueryString();
    }
}
