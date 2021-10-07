<?php

namespace App\Services;

use App\Models\CalorificValue;

class SearchService
{
    public function searchQuery($fromDate, $toDate, $areaId)
    {
        return CalorificValue::where('applicable_for', '>=' , $fromDate  )
                    ->where('applicable_for', '<=', $toDate)
                    ->where('area_id', $areaId)
                    ->get();
    }

}
