<?php

namespace App\Models;

use App\Http\Traits\Hashidable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

class Receipt extends Model
{
    use HasFactory ,SoftDeletes , Hashidable;

    protected $fillable = [
        'orders_ids',
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
        'orders_ids' => 'array',
    ];

    protected $appends = ['hashid'];

    public function orders()
    {
        return  $this->hasMany(Order::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function getHashidAttribute($value)
    {
        return Hashids::connection(get_called_class())->encode($this->attributes['id']);
        // return Hashids::encode($this->attributes['id']);
    }
}
