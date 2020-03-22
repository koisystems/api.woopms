<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRoomstays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_roomstays', function (Blueprint $table) {
            $table->id();
            $table->integer("property_id");
            $table->integer("booking_id");
            $table->integer("room_inventory_id");
            $table->string("room_inventory_code");

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
        Schema::dropIfExists('booking_roomstays');
    }
}
