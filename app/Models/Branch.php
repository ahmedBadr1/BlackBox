<?php

namespace App\Models;

use App\Models\System\Location;
use App\Models\System\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Branch extends Model
{
    use HasFactory , SoftDeletes  ,LogsActivity;

    protected $fillable = [
        'name',
        'phone',
        'state_id',
        'user_id',
        'address'
    ];

    protected static $recordEvents = ['updated','deleted'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => "This Branch has been {$eventName}")
            ->logOnly(['name', 'phone', 'location_id','user_id'])
            ->logOnlyDirty()
            ->useLogName('Order');
        // Chain fluent methods for configuration options
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function manager()
    {
    //    $mangers = User::role(['manager'])->get();
        return $this->belongsTo(User::class,'user_id');
    }
    public function location()
    {
        return $this->morphOne(Location::class, 'locationable');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
