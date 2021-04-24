<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteSenderRecipientDetailsFromDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropColumn('sender_phone');
            $table->dropColumn('sender_address');
            $table->dropColumn('sender_email');
            $table->dropColumn('recipient_phone');
            $table->dropColumn('recipient_address');
            $table->dropColumn('recipient_email');
            $table->dropColumn('customer_phone');
            $table->dropColumn('customer_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            //
        });
    }
}
