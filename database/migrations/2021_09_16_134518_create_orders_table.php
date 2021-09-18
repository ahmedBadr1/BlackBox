<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->startingValue(65000);
            $table->string('product_name')->nullable();
            $table->string('value')->nullable();
            $table->string('cust_name');
            $table->string('cust_num');
            $table->string('address');
            $table->string('quantity')->default(1);
            $table->string('state');
            $table->foreignIdFor(\App\Models\Area::class);
            $table->string('notes')->default('no notes')->nullable();
            $table->string('status');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(\App\Models\Receipt::class)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
