<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Order::class)->default(0);
            $table->unsignedBigInteger('orders_count');
            $table->unsignedBigInteger('sub_total')->nullable();
            $table->unsignedBigInteger('discount')->nullable();
            $table->unsignedBigInteger('tax')->nullable();
            $table->unsignedBigInteger('total');
            $table->foreignIdFor(User::class);
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
        Schema::dropIfExists('receipts');
    }
}
