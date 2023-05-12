<?php

namespace App\Models;

use App\Http\Traits\Hashidable;
use App\Models\System\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Vinkla\Hashids\Facades\Hashids;


class Order extends Model
{
    use HasFactory , SoftDeletes , Hashidable ,LogsActivity;
    use \Znck\Eloquent\Traits\BelongsToThrough;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type',

        'product',
        'consignee',
       'details',

        'area_id',
        'status_id',
        'receipt_id',
        'user_id',
        'cost',
        'sub_total',
        'discount',
        'tax',
        'total',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
        'receipt_id',
        'cost',
    ];

    protected $appends = ['hashid'];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'cod' => 'boolean',
        'product'=> 'array',
        'consignee'=> 'array',
        'details'=> 'array',
    ];

    public static $types = ['deliver','exchange','return','cash'];

    protected static $recordEvents = ['updated','deleted'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => "This Order has been {$eventName}")
            ->logOnly(['product', 'consignee', 'details','user.name'])
            ->logOnlyDirty()
            ->useLogName('Order');
        // Chain fluent methods for configuration options
    }
    public function state()
    {
        return  $this->belongsToThrough('App\Models\System\State', 'App\Models\Area');
    }
    public function business()
    {
        return  $this->belongsToThrough('App\Models\Business',['App\Models\User']);
    }
    public function user()
    {
        return  $this->belongsTo(User::class);
    }
    public function delivery()
    {
        return  $this->belongsTo(User::class,'delivery_id');
    }
    public function area()
    {
        return  $this->belongsTo(Area::class);
    }
    public function receipt()
    {
        return  $this->belongsTo(Receipt::class);
    }
    public function status()
    {
        return  $this->belongsTo(Status::class);
    }

    public function scopeMyOrders($query)
    {
        return $query->where('user_id', auth()->id());
    }


    public function getHashidAttribute($value)
    {
        return Hashids::connection(get_called_class())->encode($this->attributes['id']);
       // return Hashids::encode($this->attributes['id']);
    }
    public  function getCreatedAtForHumansAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public static function search($search)
    {
        $id =    Hashids::Connection(Order::class)->decode(strtolower($search)) ?? 0;
        return empty($search) ? static::query()
            : static::query()->where('id', 'like', '%'.$search.'%')
                ->orWhere('product', 'like', '%'.$search.'%')
                ->orWhere('consignee', 'like', '%'.$search.'%')
                ->orWhere('details', 'like', '%'.$search.'%')
                ->orWhere('id', '=', $id)
                ->orWhereHas('user', fn($q) => $q->where('name','like', '%'.$search.'%'))
                ->orWhereHas('area', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }



    public static function searchSeller($search,$uid)
    {       $id =    Hashids::Connection(Order::class)->decode(strtolower($search)) ?? 0;
        return empty($search) ? static::query()
            : static::query()->where('user_id', $uid)
                ->where(function ($query) use ($search ,$id) {
                    $query->orWhere('product', 'like', '%'.$search.'%');
                    $query->orWhere('consignee', 'like', '%'.$search.'%');
                    $query->orWhere('details', 'like', '%'.$search.'%');
                    $query->orWhere('id', '=', $id);
                    $query->orWhereHas('user', fn($q) => $q->where('name','like', '%'.$search.'%'));
                    $query->orWhereHas('area', fn($q) => $q->where('name','like', '%'.$search.'%'));
                });
    }

}
