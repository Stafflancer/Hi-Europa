<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users'))
        {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'residency_type'))
                {
                    $table->string('residency_type');
                }
                if (!Schema::hasColumn('users', 'residence_type'))
                {
                    $table->string('residence_type');
                }
                if (!Schema::hasColumn('users', 'floor'))
                {
                    $table->string('floor');
                }
                if (!Schema::hasColumn('users', 'number_rooms'))
                {
                    $table->integer('number_rooms');
                }
                if (!Schema::hasColumn('users', 'got_insurance'))
                {
                    $table->boolean('got_insurance');
                }
                if (!Schema::hasColumn('users', 'live_there_time'))
                {
                    $table->string('live_there_time');
                }
                if (!Schema::hasColumn('users', 'insured_time'))
                {
                    $table->string('insured_time');
                }
                if (!Schema::hasColumn('users', 'is_pb_prime'))
                {
                    $table->boolean('is_pb_prime');
                }

                if (!Schema::hasColumn('users', 'contract_id'))
                {
                    $table->unsignedBigInteger('contract_id')->nullable();
                    $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('users'))
        {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'residency_type'))
                {
                    $table->dropColumn('residency_type');
                }
                if (Schema::hasColumn('users', 'residence_type'))
                {
                    $table->dropColumn('residence_type');
                }
                if (Schema::hasColumn('users', 'floor'))
                {
                    $table->dropColumn('floor');
                }
                if (Schema::hasColumn('users', 'number_rooms'))
                {
                    $table->dropColumn('number_rooms');
                }
                if (Schema::hasColumn('users', 'got_insurance'))
                {
                    $table->dropColumn('got_insurance');
                }
                if (Schema::hasColumn('users', 'live_there_time'))
                {
                    $table->dropColumn('live_there_time');
                }
                if (Schema::hasColumn('users', 'insured_time'))
                {
                    $table->dropColumn('insured_time');
                }
                if (Schema::hasColumn('users', 'is_pb_prime'))
                {
                    $table->dropColumn('is_pb_prime');
                }

                if (Schema::hasColumn('users', 'contract_id'))
                {
                    $table->dropColumn('contract_id');
                }
            });
        }
    }
}
