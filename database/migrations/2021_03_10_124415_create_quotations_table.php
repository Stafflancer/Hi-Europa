<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('postal_code');
            $table->string('type_accommodation');
            $table->string('prospect_type');
            $table->string('type_residence');
            $table->string('apartment_floor');
            $table->string('apartment_surface');
            $table->string('precision_tree');
            $table->integer('room')->default(0);
            $table->integer('living_room')->default(0);
            $table->integer('library')->default(0);
            $table->integer('mezzanine')->default(0);
            $table->boolean('insured')->default(true);
            $table->boolean('termination')->default(true);
            $table->integer('franchise')->default(0);  
            $table->integer('furniture_capital')->default(0);  
            $table->boolean('furniture_two_years_old')->default(true);
            $table->integer('total_value_furniture_400')->default(0);  
            $table->integer('total_value_furniture_1800')->default(0);  
            $table->integer('estimated_coverage')->default(0);  
            $table->boolean('option_glass')->default(true);
            $table->boolean('option_thief')->default(true);
            $table->boolean('option_mobile')->default(true);
            $table->boolean('protect_legal')->default(true);
            $table->boolean('school_insurance')->default(true);
            $table->boolean('dependencies')->default(true);
            $table->unsignedBigInteger('cost_month')->default(0);  

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('contract_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');

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
        Schema::dropIfExists('quotations');
    }
}
