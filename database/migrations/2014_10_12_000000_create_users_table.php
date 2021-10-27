<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->integer('balance')->default(0);
            $table->string('hearAboutUs')->default('none');
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignIdFor(\App\Models\Business::class)->default(0);
            $table->foreignIdFor(\App\Models\Plan::class)->default(1);
            $table->string('password');
            $table->boolean('active')->default(1);
            $table->dateTime('last_action_at')->nullable();
            $table->string('google_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
