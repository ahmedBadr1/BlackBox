<?php

namespace App\Models;

use App\Models\System\Location;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable= ['type','due_to','delivery_id','user_id','confirmed_at','done_at','notes','location_id'];

    public static array $types = ['pickup', 'dropoff','else'];

    protected $casts = [  'due_to'=>'datetime','done_at'=>'datetime' , 'confirmed_at' => 'datetime'];

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

    function scopeMine($query)
    {
        return $query->where('delivery_id',auth()->id());
    }

    function scopeDate($query,$date)
    {
        if ($date == 'today'){
            return $query->whereBetween('due_to',[ now(), Carbon::today()]);
        }elseif ($date == 'tomorrow'){
            return $query->whereBetween('due_to', [ now(), Carbon::tomorrow()]);
        }elseif($date == 'week'){
            return $query->whereBetween('due_to', [ now(), now()->addWeek()]);
        }elseif($date == 'month'){
            return $query->whereBetween('due_to', [ now(),now()->addMonth()]);
        }else{
            return $query->whereYear('created_at', '2023');
        }
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
    public  function getConfirmedAttribute()
    {
        return $this->confirmed_at->diffForHumans();
    }
    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('type', 'like', '%'.$search.'%')
                ->orWhere('notes', 'like', '%'.$search.'%')
                ->orWhereHas('user', fn($q) => $q->where('name','like', '%'.$search.'%'))
                ->orWhereHas('delivery', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }

}
