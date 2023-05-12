<?php

namespace App\Models\System;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class Location extends Model
{
    use HasFactory , BelongsToThrough ;
    protected $fillable = [
        'name',
        'area_id',
        'street',
        'building',
        'floor',
        'apartment',
        'landmarks',
        'longitude',
        'latitude',
        'locationable_type',
        'locationable_id',
    ];

    public function locationable()
    {
        return $this->morphTo();
    }

    public function state()
    {
        return $this->belongsToThrough('App\Models\System\State','App\Models\Area');
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

//    public function user()
//    {
//        return $this->belongsTo(User::class ,'model_id')->where('model_type','User');
//    }

}
