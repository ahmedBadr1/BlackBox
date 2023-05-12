<?php

namespace App\Models;

use App\Models\System\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'contact',
        'industry',
        'channel',
        'url',
    ];
    public static $industries = [
        'books and arts',
        'electronics',
        'Fashion',
        'cosmetics and personal care',
        'jewelry and accessories',
        'sports wear',
        'medical supplies',
        'home and living'];

    public static $channels = ['website','offline store','Facebook','Instagram','marketplace'];

    public function location()
    {
        return $this->morphOne(Location::class, 'locationable');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function orders()
    {
        return $this->hasManyThrough(Order::class,User::class);
    }
    public function ordersMonthly($month)
    {
        return $this->hasManyThrough(Order::class,User::class)->whereMonth('orders.created_at',$month);
    }
}
