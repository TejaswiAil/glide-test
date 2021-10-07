<?php

namespace App\Models;

use GuzzleHttp\Client;
use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalorificValue extends Model
{
    use HasFactory;

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    protected $with = ["area"];

    protected $casts = ['applicable_for'=>'date'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

}
