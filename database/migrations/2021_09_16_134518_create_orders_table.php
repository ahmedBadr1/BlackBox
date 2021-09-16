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
            $table->increments('id')->start_from(60000);
            $table->string('value');
            $table->string('cust_name');
            $table->string('cust_num');
            $table->string('address');
            $table->string('quantity');
            $table->string('state');
            $table->string('area');
            $table->string('notes')->nullable();
            $table->string('status');
            $table->foreignIdFor(User::class);
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
