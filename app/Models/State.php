<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;


    public function zones()
    {
        return $this->hasMany(Zone::class);
    }
    public function areas()
    {
        return $this->hasManyThrough(Area::class,Zone::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
