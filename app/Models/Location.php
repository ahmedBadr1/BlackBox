<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'state_id',
        'area_id',
        'street',
        'building',
        'floor',
        'apartment',
        'landmarks',
        'longitude',
        'latitude',
        'model_type',
        'model_id',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function locationable()
    {
        return $this->morphTo();
    }

//    public function user()
//    {
//        return $this->belongsTo(User::class ,'model_id')->where('model_type','User');
//    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

}
