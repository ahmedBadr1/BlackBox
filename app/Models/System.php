<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;
    protected $fillable = [

        'company_name',
        'company_logo',

        'owner',
        'email',
        'contact',

        'theme',
        'footer',

        'reschedule_limit',
        'package_weight_limit',
        'auto_send',

    ];
    protected $casts = [
        'auto_send' => 'boolean'
    ];
    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
