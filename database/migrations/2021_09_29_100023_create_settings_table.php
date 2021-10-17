<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->foreignIdFor(\App\Models\Location::class)->nullable();
            $table->string('slogan')->nullable();
            $table->string('footer')->nullable();
            $table->string('owner')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->smallInteger('reschedule_limit')->nullable()->default(3);
            $table->smallInteger('package_weight_limit')->nullable()->default(5);
            $table->string('theme')->nullable();
            $table->boolean('auto_send')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
