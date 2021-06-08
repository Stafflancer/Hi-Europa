<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateResiliationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('resiliations'))
        {
            Schema::table('resiliations', function (Blueprint $table) {
                if (!Schema::hasColumn('resiliations', 'contract_id'))
                {
                    $table->unsignedBigInteger('contract_id')->nullable();
                    $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('resiliations', 'insured_firstname'))
                {
                    $table->string('insured_firstname');
                }
                if (!Schema::hasColumn('resiliations', 'insured_surname'))
                {
                    $table->string('insured_surname');
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
        if (Schema::hasTable('resiliations'))
        {
            Schema::table('resiliations', function (Blueprint $table) {
                if (Schema::hasColumn('resiliations', 'contract_id'))
                {
                    $table->dropColumn('contract_id');
                }
                if (Schema::hasColumn('resiliations', 'insured_firstname'))
                {
                    $table->dropColumn('insured_firstname');
                }
                if (Schema::hasColumn('resiliations', 'insured_surname'))
                {
                    $table->dropColumn('insured_surname');
                }
            });
        }
    }
}
