<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable= ['type','delivery_id','user_id','notes'];
    public const PICKUP = 'Pick Up';
    public const DROPOFF = 'Drop Off';
    public static array $types = ['pickup', 'dropoff','else'];


    public function delivery()
    {
        return $this->belongsTo(User::class, 'delivery_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
