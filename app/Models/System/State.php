<?php

namespace App\Models\System;

use App\Models\Area;
use App\Models\Branch;
use App\Models\Order;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function areas()
    {
        return $this->hasMany(Area::class);
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
