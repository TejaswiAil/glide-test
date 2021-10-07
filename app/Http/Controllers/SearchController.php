<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(private SearchService $searchService)
    {

    }

    public function show()
    {
        $areas = Area::get();

        return view('search')
            ->with('areas', $areas)
            ->with('fromDate',null)
            ->with('toDate',null)
            ->with('areaId',null);
    }

    public function search(Request $request)
    {

        $fromDate = $request->input('startDate');
        $toDate = $request->input('endDate');
        $areaId = $request->input('areaId');

        $calorificValues = $this->searchService->searchQuery($fromDate, $toDate, $areaId);

        $areas = Area::get();

        return view('search')
        ->with('calorificValues', $calorificValues)
        ->with('areas', $areas)
        ->with('fromDate',$fromDate)
        ->with('toDate',$toDate)
        ->with('areaId',$areaId);

    }


}
