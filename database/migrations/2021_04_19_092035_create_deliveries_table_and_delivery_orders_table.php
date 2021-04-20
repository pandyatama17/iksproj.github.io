<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTableAndDeliveryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
          $table->id();
          $table->string('code',10);
          $table->string('sender_name');
          $table->longText('sender_address');
          $table->string('sender_phone',15);
          $table->string('sender_email',25);
          $table->string('recipient_name');
          $table->longText('recipient_address');
          $table->string('recipient_phone',15);
          $table->string('recipient_email',25);
          $table->string('freight_load',50);
          $table->timestamps();
        });
        Schema::create('delivery_orders', function (Blueprint $table) {
          $table->id();
          $table->integer('delivery_id');
          $table->string('do_number',15);
          $table->timestamp('date')->useCurrent = true;
          $table->integer('driver_id');
          $table->bigInteger('fare');
          $table->integer('status')->default(0);
          $table->integer('tonnage');
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
        Schema::dropIfExists('deliveries');
        Schema::dropIfExists('delivery_orders');
    }
}
