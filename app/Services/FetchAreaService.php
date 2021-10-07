<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FetchAreaService
{
    use HasFactory;

    function get(){
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://mip-prd-web.azurewebsites.net'

        ]);
        $response = $client->request('GET', '/api/v2/DataItemCategoryTree?id=408');

        $result = (json_decode($response->getBody(),true));

        foreach($result['children'] as $key=>$value) {
                $name = $value['name'];
                $uniqId = $value['uniqueId'];
                $stagingId = $value['stagingId'];

                $name= (str_replace('Calorific Value, ', '', $name));
                $name = str_replace(')', '', str_replace('LDZ(', '', $name));

                $area = Area::updateOrCreate(
                    ['unique_id' => $uniqId, 'staging_id' => $stagingId],
                    ['name' => $name]
                );
        }

    }
}
