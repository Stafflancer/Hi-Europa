<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('prospects'))
        {
            Schema::table('prospects', function (Blueprint $table) {
                if (!Schema::hasColumn('prospects', 'postal_code'))
                {
                    $table->integer('postal_code');
                }
                if (!Schema::hasColumn('prospects', 'email'))
                {
                    $table->string('email');
                }
                if (!Schema::hasColumn('prospects', 'opt_in_hieuropa'))
                {
                    $table->boolean('opt_in_hieuropa');
                }

                if (Schema::hasColumn('prospects', 'contract_id'))
                {
                    $table->dropForeign('prospects_contract_id_foreign');
                    $table->dropColumn('contract_id');
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
        if (Schema::hasTable('prospects'))
        {
            Schema::table('prospects', function (Blueprint $table) {
                if (Schema::hasColumn('prospects', 'postal_code'))
                {
                    $table->dropColumn('postal_code');
                }
                if (Schema::hasColumn('prospects', 'email'))
                {
                    $table->dropColumn('email');
                }
                if (Schema::hasColumn('prospects', 'opt_in_hieuropa'))
                {
                    $table->dropColumn('opt_in_hieuropa');
                }
                
                if (!Schema::hasColumn('prospects', 'contract_id'))
                {
                    $table->unsignedBigInteger('contract_id')->nullable();
                    $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
                }
            });
        }
    }
}
