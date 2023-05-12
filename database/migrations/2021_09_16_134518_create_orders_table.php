<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->increments('id')->startingValue(1); // check again
            $table->string('type');
            $table->text('product');
            $table->text('consignee');
            $table->text('details');
            $table->foreignIdFor(\App\Models\Area::class);
            $table->foreignIdFor(\App\Models\System\Status::class);
            $table->foreignIdFor(User::class);
            $table->smallInteger('cost');
            $table->mediumInteger('sub_total');
            $table->mediumInteger('discount');
            $table->mediumInteger('tax');
            $table->mediumInteger('total');
            $table->boolean('printed')->default(0);
            $table->unsignedBigInteger('delivery_id')->nullable();
            $table->dateTime('received_at')->nullable();
            $table->dateTime('expire_at')->nullable();
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
