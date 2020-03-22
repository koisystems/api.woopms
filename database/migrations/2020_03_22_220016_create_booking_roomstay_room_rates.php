<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRoomstayRoomRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_roomstay_room_rates', function (Blueprint $table) {
            $table->id();
            $table->integer("property_id");
            $table->integer("booking_id");
            $table->integer("booking_roomstay_id");
            $table->integer("rate_plan_id");
            $table->string("rate_plan_code");
            $table->date("start_date");
            $table->date("end_date");

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
        Schema::dropIfExists('booking_roomstay_rate_plan');
    }
}
