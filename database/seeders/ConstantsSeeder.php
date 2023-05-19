<?php

namespace Database\Seeders;

use App\Models\Accounting\Account;
use App\Models\Accounting\Category;
use App\Models\Feature;
use App\Models\Packing;
use App\Models\Plan;
use App\Models\System\State;
use App\Models\System\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
        //              1         2       3       4             5               6              7           8         9           10         11
        $statuses = ['pending','ready','picked','inline','out-for-delivery','rescheduled','delivered','cancelled','refused','returning','returned'];

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
        $categories = [
            'assets' => null,
            'liabilities' => null,
//            'owner equity' => null,
            'revenue' => null,
            'expenses' => null,
            'fixed assets' => 1,
            'current assets' => 1,
            'intangible assets' => 1,
            'long term loans' => 2,
            'short term loans' => 2,
            'long term liabilities' => 2 ,
            'current owners' => 3,
            'prepaid revenue' => 4,
            'accrued expenses' => 5,
            'admin expenses' => 5,
            'general expenses' => 5,
        ];
        foreach ($categories as $key => $val) {
            Category::factory()->create([
                'name' => $key,
                'slug' =>  Str::slug($key) ,
                'type' => 'account',
                'parent_id' => $val,
            ]);
        }
         $accounts  =  array(
           array( "code" => 201,
               "name" => "capital",
               "category_id" => 2,
               "type" => "credit"
           ),
             array( "code" => 202,
                 "name" => "capital",
                 "category_id" => 2,
                 "type" => "credit"),
         );

        foreach ($accounts as $account ) {
            Account::factory()->create([
                'name' => $account['name'],
                'type' => $account['type'],
                'category_id' => $account['category_id'],
            ]);
        }

    }
}
