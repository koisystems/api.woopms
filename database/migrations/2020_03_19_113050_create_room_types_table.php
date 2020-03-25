<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id');
            $table->string('code');
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('max_persons')->default(0);
            $table->integer('max_adults')->default(0);
            $table->integer('max_children')->default(0);
            $table->integer('max_infants')->default(0);
            $table->integer('number_units')->default(0);
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
        Schema::dropIfExists('room_types');
    }
}
