<?php

namespace App\Models;

use App\Http\Traits\Hashidable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Route;
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
        'product_name',
        'value',
        'cust_name',
        'cust_num',
        'address',
        'cod',
        'package_type',
        'deliver_before',
        'package_weight',
        'area_id',
        'quantity',
        'notes',
        'status_id',
        'receipt_id',
        'user_id',
        'total'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
        'receipt_id',
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
    ];


    protected static $recordEvents = ['updated','deleted'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => "This Order has been {$eventName}")
            ->logOnly(['product_name', 'cust_name', 'cust_num','address','value','quantity','user.name'])
            ->logOnlyDirty()
            ->useLogName('Order');
        // Chain fluent methods for configuration options
    }
    public function state()
    {
        return  $this->belongsToThrough('App\Models\State',['App\Models\Zone', 'App\Models\Area']);
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
                ->orWhere('product_name', 'like', '%'.$search.'%')
                ->orWhere('cust_name', 'like', '%'.$search.'%')
                ->orWhere('cust_num', 'like', '%'.$search.'%')
                ->orWhere('id', '=', $id)
                ->orWhereHas('user', fn($q) => $q->where('name','like', '%'.$search.'%'))
                ->orWhereHas('area', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }

    public static function searchSeller($search,$uid)
    {       $id =    Hashids::Connection(Order::class)->decode(strtolower($search)) ?? 0;
        return empty($search) ? static::query()
            : static::query()->where('user_id', $uid)
                ->where(function ($query) use ($search ,$id) {
                    $query->orWhere('product_name', 'like', '%'.$search.'%');
                    $query->orWhere('cust_name', 'like', '%'.$search.'%');
                    $query->orWhere('cust_num', 'like', '%'.$search.'%');
                    $query->orWhere('total', 'like', '%'.$search.'%');
                    $query->orWhere('id', '=', $id);
                    $query->orWhereHas('area', fn($q) => $q->where('name','like', '%'.$search.'%'));
                });
    }


}
