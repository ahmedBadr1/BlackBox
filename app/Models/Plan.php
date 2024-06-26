<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'orders_count',
        'pickup_cost',
        'area'
    ];

    protected $casts = ['area'=>'array'];
    public function features(){
        return $this->belongsToMany(Feature::class);
    }
}
