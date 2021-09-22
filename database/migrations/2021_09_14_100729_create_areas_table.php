<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('delivery_cost');
            $table->unsignedBigInteger('return_cost');
            $table->unsignedBigInteger('replacement_cost');
            $table->unsignedBigInteger('over_weight_cost');
            $table->unsignedBigInteger('delivery_time');
            $table->foreignIdFor(\App\Models\Zone::class)->nullable();
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
        Schema::dropIfExists('areas');
    }
}
