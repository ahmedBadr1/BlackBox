<?php

namespace App\Models;

use App\Models\System\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable= ['type','due_to','delivery_id','user_id','notes','location_id'];
    public const PICKUP = 'Pick Up';
    public const DROPOFF = 'Drop Off';
    public static array $types = ['pickup', 'dropoff','else'];
    protected $dates = [
        'due_to',
        'done_at'
    ];

    public function delivery()
    {
        return $this->belongsTo(User::class, 'delivery_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public  function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public  function getDoneAttribute()
    {
        return $this->done_at->diffForHumans();
    }
    public  function getDueAttribute()
    {
        return $this->due_to->diffForHumans();
    }

}
