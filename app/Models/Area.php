<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'delivery_cost',
        'return_cost',
        'replacement_cost',
        'over_weight_cost',
        'delivery_time',
        'zone_id',
        'state'
    ];
    public function zone()
    {
        return  $this->belongsTo(Zone::class);
    }
    public function orders()
    {
        return  $this->hasMany(Order::class);
    }

    public function state()
    {
        return $this->belongsToThrough('App\Models\State', 'App\Models\Zone');
    }


//    public function availableOrders()
//    {
//        return  $this->hasMany(Order::class,function($q) {
//            $q->whereIn('status_id', [3,6,7,8]);
//        });
//    }




}
