<?php

namespace App\Models;

use App\Models\System\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'state_id'];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
    public function users()
    {
        return  $this->belongsToMany(User::class);
    }

}
