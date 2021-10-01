<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Plan;
use App\Models\State;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;

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
        $states = ['القاهرة','الجيزة','الإسكندرية','الإسماعيليّة','أسوان','أسيوط','الأقصر','البحر الأحمر','بني سويف','البحيرة','بورسعيد','جنوب سيناء','الدقهلية','دمياط','سوهاج','السويس','الشرقيّة','شمال سيناء','الغربيّة','قنا','كفر الشيخ','مرسى مطروح','المنوفيّة','المنيا','الوادي الجديد'];

        foreach ($states as $state){
            State::factory()->create([
                'name' => $state,
            ]);
        }
       $statuses = ['pending','ready','inline','out for delivery','rescheduled','delivered','cancelled','refused','returning','returned'];

        foreach ($statuses as $status){
            Status::factory()->create([
                'name' => $status,
            ]);
        }
        $plans= ['basic','gold','silver','platinum'];

        foreach ($plans as $plan) {
            Plan::factory()->create([
                'name' => $plan,
                'orders_count' => rand(10,500),
                  'pickup_cost' => rand(0,20),
            ]);
        }
            $features = ['clients','products','trash'];

            foreach ($features as $feature){
                Feature::factory()->create([
                    'name' => $feature,

                ]);
        }

    }
}
