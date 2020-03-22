<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRoomstayRoomRateRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_roomstay_room_rate_rates', function (Blueprint $table) {
            $table->id();
            $table->integer("property_id");
            $table->integer("booking_id");
            $table->integer("booking_roomstay_id");
            $table->integer("booking_roomstay_room_rate_id");
            $table->date("stay_date");
            $table->float("amount",8,2);
            $table->string("currency")->nullable();
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
        Schema::dropIfExists('booking_roomstay_room_rate_rates');
    }
}
