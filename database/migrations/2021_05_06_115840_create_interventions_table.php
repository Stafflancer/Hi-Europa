<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('city')->nullable();
            $table->string('comp_address')->nullable();
            $table->boolean('attendance_person');
            $table->string('other_person_first_name')->nullable();
            $table->string('other_person_last_name')->nullable();
            $table->string('other_person_phone')->nullable();
            $table->unsignedBigInteger('ima_user_id')->nullable();

            $table->foreign('ima_user_id')->references('id')->on('ima_users')->onDelete('cascade');
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
        Schema::dropIfExists('interventions');
    }
}
