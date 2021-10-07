<?php

namespace App\Http\Controllers;

use App\Services\FetchAreaService;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    //

    public function __construct(private FetchAreaService $fetchAreaService)
    {
    }

    public function get()
    {
        $this->fetchAreaService->get();

        return view("area");
    }
}
