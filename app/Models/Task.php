<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable= ['type','assign_to','user_id'];
    public const PICKUP = 'Pick Up';
    public const DROPOFF = 'Drop Off';
    public static array $types = ['pickup', 'dropoff','else'];


    public function delivery()
    {
        return $this->belongsTo(User::class, 'delivery_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
