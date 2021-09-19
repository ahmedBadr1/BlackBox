<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\Status;
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
        $states = ['القاهرة','الجيزة','الإسكندرية','الإسماعيليّة','أسوان','أسيوط','الأقصر','البحر الأحمر','بني سويف','البحيرة','بورسعيد','جنوب سيناء','الدقهلية','دمياط','سوهاج','السويس','الشرقيّة','شمال سيناء','الغربيّة','قنا','كفر الشيخ','مرسى مطروح','المنوفيّة','المنيا','الوادي الجديد'];

        foreach ($states as $state){
            State::factory()->create([
                'name' => $state,
            ]);
        }
       $statuses = ['pending','in-way','cancelled','returned','delivering','delivered','rescheduled','refused','returning'];

        foreach ($statuses as $status){
            Status::factory()->create([
                'name' => $status,
            ]);
        }
    }
}
