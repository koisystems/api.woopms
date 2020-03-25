<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_rates', function (Blueprint $table) {
            $table->id();
            $table->integer("property_id");
            $table->integer("room_type_id");
            $table->integer("rate_plan_id");
            $table->text("description")->nullable();
            $table->integer("included_number_persons");
            $table->integer("max_number_persons")->nullable();
            $table->integer("default_min_stay")->nullable();
            $table->float("rack_rate",8,2);
            $table->float("extra_adult_rate",8,2)->default(0);
            $table->float("extra_child_rate",8,2)->default(0);
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
        Schema::dropIfExists('room_rates');
    }
}
