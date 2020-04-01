<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomRateCalendar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_rate_calendar', function (Blueprint $table) {
            $table->id();
            $table->integer("property_id");
            $table->integer("room_rate_id");
            $table->integer("room_type_id");
            $table->integer("rate_plan_id");
            $table->date("stay_date");
            $table->float("rate_amount",8,2);
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
        Schema::dropIfExists('room_rate_calendar');
    }
}
