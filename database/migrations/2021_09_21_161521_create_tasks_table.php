<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignIdFor(\App\Models\Location::class);
            $table->dateTime('due_to')->nullable();
            $table->foreignId('delivery_id')
            ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->nullable();
            $table->foreignIdFor(User::class);
            $table->text('notes')->nullable();
            $table->dateTime('done_at')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
