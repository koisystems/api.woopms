<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_plans', function (Blueprint $table) {
            $table->id();
            $table->integer("property_id");
            $table->string("code");
            $table->string("title");
            $table->string("description")->nullable();
            $table->integer("min_persons")->default(1);
            $table->integer("max_persons")->nullable();
            $table->integer("min_stay")->default(1);
            $table->integer("max_stay")->nullable();
            $table->string("period")->default("daily");

            $table->integer("cutoff_days")->nullable();
            $table->integer("allotment")->default(1);
            $table->boolean("commissionable")->default(true);
            $table->boolean("is_special_rate")->default(false);

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
        Schema::dropIfExists('rate_plans');
    }
}
