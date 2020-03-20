<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_rules', function (Blueprint $table) {
            $table->id();
            $table->integer("property_id");
            $table->integer("policy_id");
            $table->integer("hours_before")->default(24);
            $table->enum("type", array("cancellation","guarantee","deposit", "modification"));
            $table->enum("charge_based_on", array("number_nights","percentage_amount","fixed_amount"))->default("number_nights");
            $table->float("amount", 8,2)->defaul(0);
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
        Schema::dropIfExists('policy_rules');
    }
}
