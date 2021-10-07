<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\CalorificValue;
use App\Services\SearchService;
use Illuminate\Http\Request;

class EditController extends Controller
{
    // public function __construct(private SearchService $searchService)
    // {

    // }

    public function edit(Request $request, $id)
    {
        $calorificValue = CalorificValue::find($id);

        $areaId = $request->input('areaId');

        $areas = Area::get();

        return view('edit')
        ->with('calorificValue', $calorificValue)
        ->with('areas', $areas);


    }

    public function update(Request $request, $id)
    {
        $calorificValue = CalorificValue::find($id);

        $calorificValue->applicable_for = $request->input('applicable_for');
        $calorificValue->value =  $request->input('value');
        $calorificValue->area_id =  $request->input('areaId');

        $calorificValue->save();

        return redirect('/search');
    }


}
