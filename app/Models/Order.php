<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory , SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'value',
        'cust_name',
        'cust_num',
        'address',
        'state',
        'area',
        'quantity',
        'notes',
        'status',
        'user_id'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
    public static array $status = ['pending','in-way','delivering','delivered','cancelled','rescheduled','refused','returning','returned'];
}
