<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'reschedule_limit',
        'package_weight_limit',
        'app_name',
        'title',
        'slogan',
        'footer',
        'owner',
        'email',
        'theme',
        'auto_send',
        'company_name',
        'location_id'
    ];
    protected $casts = [
        'auto_send' => 'boolean'
    ];
    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
