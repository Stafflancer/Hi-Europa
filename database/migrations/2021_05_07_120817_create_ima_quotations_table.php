<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImaQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ima_quotations', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('problem_type');
            $table->string('precision_one');
            $table->string('precision_two')->nullable();
            $table->string( 'precision_tree')->nullable();
            $table->dateTime('intervention_date');
            $table->dateTime('start_time');
            $table->decimal('cost');
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
        Schema::dropIfExists('ima_quotations');
    }
}
