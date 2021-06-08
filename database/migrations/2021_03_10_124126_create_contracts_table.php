<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('exact_address');
            $table->string('additional_address');
            $table->string('city');
            $table->string('postal_code');
            $table->string('moving_out_of_home');
            $table->string('insurer_name');
            $table->string('insured_name');
            $table->string('insurance_contract_number');
            $table->string('insurance_date');
            $table->string('contract_start_date');
            $table->string('contract_expiration_date');
            $table->string('dependance_postal_code');
            $table->string('dependance_adresse');
            $table->string('dependance_comp_adresse');
            $table->string('dependance_city');
            $table->string('pdf')->nullable();
            $table->string('live_home_insure');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('contracts');
    }
}
