<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Packing;
use App\Models\Plan;
use App\Models\System\State;
use App\Models\System\Status;
use Illuminate\Database\Seeder;

class ConstantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $states = [
            'Alexandria' => 'الإسكندرية',
            'Aswan' => 'أسوان',
            'Asyut' => 'أسيوط',
            'Beheira' => 'البحيرة',
            'Beni Suef' => 'بني سويف',
            'Cairo' => 'القاهرة',
            'Dakahlia' => 'الدقهلية',
            'Damietta' => 'دمياط',
            'Faiyum' => 'الفيوم',
            'Gharbia' => 'الغربية',
            'Giza' => 'الجيزة',
            'Ismailia' => 'الإسماعيلية',
            'Kafr El Sheikh' => 'كفر الشيخ',
            'Luxor' => 'الأقصر',
            'Matrouh' => 'مطروح',
            'Minya' => 'المنيا',
            'Monufia' => 'المنوفية',
            'New Valley' => 'الوادي الجديد',
            'North Sinai' => 'شمال سيناء',
            'Port Said' => 'بورسعيد',
            'Qalyubia' => 'القليوبية',
            'Qena' => 'قنا',
            'Red Sea' => 'البحر الأحمر',
            'Sharqia' => 'الشرقية',
            'Sohag' => 'سوهاج',
            'South Sinai' => 'جنوب سيناء',
            'Suez' => 'السويس',
        ];
        foreach ($states as $key => $val) {
            State::factory()->create([
                'name' => $key,
                'name_ar' => $val ,
            ]);
        }

        $statuses = ['pending','ready','inline','out-for-delivery','rescheduled','delivered','cancelled','refused','returning','returned'];

        foreach ($statuses as $status){
            Status::factory()->create([
                'name' => $status,
                'type' => 'order'
            ]);
        }
        $plans= ['basic'];

        foreach ($plans as $plan) {
            Plan::factory()->create([
                'name' => $plan,
                'orders_count' => rand(10,500),
                  'pickup_cost' => rand(0,20),
                'area' => []
            ]);
        }
        $features = ['clients','products','trash'];

        foreach ($features as $feature){
            Feature::factory()->create([
                'name' => $feature,
            ]);
        }


        $packing = [
        'Poly Bags',
        'Paperboard Boxes',
        'Paper Bag',
        'Bottle & Cap Packaging',
        'Corrugated Boxes',
        'Plastic Boxes',
        'Side Gusset Bags',
        'Rigid',
        ];
        foreach($packing as $type){
            Packing::factory()->create([
                'type' => $type,
                'price' => rand(.25,5),
                'size' => rand(10,100),
            ]);
        }



    }
}
