<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_ids',
        'orders_count',
        'sub_total',
        'discount',
        'tax',
        'total',
        'user_id',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'order_ids' => 'array',
    ];

    public function orders()
    {
        return  $this->hasMany(Order::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
