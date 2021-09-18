<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'bio',
        'address',
        'profile_photo',
        'url',
    ];


    public function user()
    {
        return  $this->belongsTo(User::class);
    }
}
