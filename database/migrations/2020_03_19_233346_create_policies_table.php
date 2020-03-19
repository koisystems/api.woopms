<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->integer("property_id");
            $table->string("code");
            $table->string("text")->nullable();
            $table->boolean("has_guarantee")->default(false);
            $table->boolean("has_deposit")->default(false);
            $table->boolean("has_cancellation_penalty")->default(false);
            $table->boolean("has_modification_penalty")->default(false);
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
        Schema::dropIfExists('policies');
    }
}
