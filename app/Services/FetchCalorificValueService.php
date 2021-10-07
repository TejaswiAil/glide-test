<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Area;
use App\Models\CalorificValue;
use Carbon\Carbon;

class FetchCalorificValueService
{
    function importValues()
    {

        $areas = Area::get();

        $publicationObjectIds = implode(",", $areas->map(function($area) {
            return $area->unique_id;
        })->toArray());

        $publicationObjectStagingIds = implode(",", $areas->map(function($area) {
            return $area->staging_id;
        })->toArray());
        $publicationObjectCount = $areas->count();

        $fromDate = \Carbon\Carbon::createFromDate(2021,01,01);
        $toDate = (new Carbon($fromDate))->addDays(30);
        $now = \Carbon\Carbon::now();

        if($toDate > $now){
            $toDate = $now;
        }

        do{

            $client = new Client();

            $response = $client->post('http://mip-prd-web.azurewebsites.net/DataItemViewer/DownloadFile', [
                'form_params' => [
                    'latestValue' => true,
                    'publicationObjectIds' => $publicationObjectIds,
                    'PublicationObjectStagingIds' => $publicationObjectStagingIds,
                    'Applicable' => "applicableFor",
                    'PublicationObjectCount' => $publicationObjectCount,
                    'FromUtcDatetime' => $fromDate->toDateTimeString(),
                    'ToUtcDateTime' => $toDate->toDateTimeString(),
                    'FileType'	=> "Csv"
                ]
                ]);

                file_put_contents(resource_path() . '/download.csv', $response->getBody()->getContents());

                $row = 1;
                if (($handle = fopen(resource_path() . '/download.csv', "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                        if($row != 1){
                            $applicableFOr = Carbon::createFromFormat('d/m/Y', $data[1]);
                            $area = $data[2];
                            $value = $data[3];

                            $area= (str_replace('Calorific Value, ', '', $area));
                            $area = str_replace(')', '', str_replace('LDZ(', '', $area));
                            $area = $areas->first(function($value) use ($area) {
                                return $value->name == $area;
                            });


                            $calorificValue = CalorificValue::updateOrCreate(
                                ['area_id' => $area->id, 'applicable_for' => $applicableFOr],
                                ['value' => $value]
                            );
                        }

                        $row++;

                    }
                    fclose($handle);
                    unlink(resource_path() . '/download.csv');
                }


            if($toDate == $now)
                return;

            $fromDate = (new Carbon($toDate))->addDays(1);
            $toDate = (new Carbon($fromDate))->addDays(30);

            if($toDate > $now){
                $toDate = $now;
            }
        }while($toDate <= $now);
    }
}


