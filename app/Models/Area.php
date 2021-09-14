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
        'price',
        'zone',
        'state'
    ];

    public static array $states = ['الجيزة','الإسكندرية','القاهرة','الإسماعيليّة','أسوان','أسيوط','الأقصر','البحر الأحمر','بني سويف','البحيرة','بورسعيد','جنوب سيناء','الدقهلية','دمياط','سوهاج','السويس','الشرقيّة','شمال سيناء','الغربيّة','قنا','كفر الشيخ','مرسى مطروح','المنوفيّة','المنيا','الوادي الجديد'];
    //public static array $states = ['cairo','giza','alex'];

}
