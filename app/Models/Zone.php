<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'rank',

        'state_id'
    ];



    public function areas()
    {
        return $this->hasMany(Area::class);
    }
    public function user()
    {
        return  $this->belongsToMany(User::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
