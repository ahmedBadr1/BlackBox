<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'app_name',
        'title',
        'slogan',
        'footer',
        'owner',
        'email',
        'theme',
        'auto_send',
    ];
    protected $casts = [
        'auto_send' => 'boolean'
    ];
}
