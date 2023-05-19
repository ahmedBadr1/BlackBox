<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('type');
            $table->text('description')->nullable();
            $table->bigInteger('opening_balance')->nullable();
            $table->dateTime('opening_balance_date')->nullable();
            $table->boolean('system')->default(false);
            $table->boolean('active')->default(true);
            $table->foreignIdFor(\App\Models\Accounting\Category::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account');
    }
};
