<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exported_deliveries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('delivery_id');
            $table->bigInteger('final_rit');
            $table->bigInteger('final_fare')->nullable();
            $table->bigInteger('final_tonnage');
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
        Schema::dropIfExists('exported_deliveries');
    }
}
