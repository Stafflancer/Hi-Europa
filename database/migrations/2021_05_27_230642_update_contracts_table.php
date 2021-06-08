<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('contracts'))
        {
            Schema::table('contracts', function (Blueprint $table) {
                if (!Schema::hasColumn('contracts', 'quotation_id'))
                {
                    $table->unsignedBigInteger('quotation_id')->nullable();
                    $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
                }
                if (!Schema::hasColumn('contracts', 'resiliation_id'))
                {
                    $table->unsignedBigInteger('resiliation_id')->nullable();
                    $table->foreign('resiliation_id')->references('id')->on('resiliations')->onDelete('cascade');
                }
                if (!Schema::hasColumn('contracts', 'price_per_month'))
                {
                    $table->decimal('price_per_month');
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
        if (Schema::hasTable('contracts'))
        {
            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'quotations_id'))
                {
                    $table->dropColumn('quotations_id');
                }
                if (Schema::hasColumn('contracts', 'resiliation_id'))
                {
                    $table->dropColumn('resiliation_id');
                }
                if (Schema::hasColumn('contracts', 'price_per_month'))
                {
                    $table->dropColumn('price_per_month');
                }
            });
        }
    }
}
