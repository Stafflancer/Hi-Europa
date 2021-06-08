<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('title')->nullable();
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->string('landline_phone')->nullable();
            $table->string('gender')->nullable()->comment('male, female');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('birthday')->nullable();
            $table->string('postal_code')->nullable();
            $table->boolean('insurance_payed')->default(0);
            $table->boolean('receive_info')->default(0);

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
        Schema::dropIfExists('users');
    }
}
