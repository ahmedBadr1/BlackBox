<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'delivery_cost',
        'return_cost',
        'replacement_cost',
        'over_weight_cost',
        'time_delivery',
        'zone_id',
        'state'
    ];
    public function zone()
    {
        return  $this->belongsTo(Zone::class);
    }
    public function orders()
    {
        return  $this->hasMany(Order::class);
    }
//    public function availableOrders()
//    {
//        return  $this->hasMany(Order::class,function($q) {
//            $q->where('status', 'in-way');
//        });
//    }

    public static array $states = ['الجيزة','الإسكندرية','القاهرة','الإسماعيليّة','أسوان','أسيوط','الأقصر','البحر الأحمر','بني سويف','البحيرة','بورسعيد','جنوب سيناء','الدقهلية','دمياط','سوهاج','السويس','الشرقيّة','شمال سيناء','الغربيّة','قنا','كفر الشيخ','مرسى مطروح','المنوفيّة','المنيا','الوادي الجديد'];
    //public static array $states = ['cairo','giza','alex'];


}
