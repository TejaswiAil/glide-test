<?php

namespace App\Http\Controllers;

use App\Services\FetchCalorificValueService;
use Illuminate\Http\Request;

class CalorificValueController extends Controller
{
    public function __construct(private FetchCalorificValueService $fetchCalorificValueService)
    {
    }

    public function get()
    {
        $this->fetchCalorificValueService->importValues();

        return "Done";
    }
}
