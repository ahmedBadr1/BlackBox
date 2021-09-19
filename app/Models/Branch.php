<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'location',
        'state_id',
        'user_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function manager()
    {
        $mangers = User::role(['manager'])->get();
        return $this->hasOne($mangers,'user_id');
    }
}
