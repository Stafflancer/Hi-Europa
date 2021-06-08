<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateResiliationsTableTypes extends Migration
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
                if (Schema::hasColumn('resiliations', 'subscription_date'))
                {
                    $table->date('subscription_date')->change();
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
                if (Schema::hasColumn('resiliations', 'subscription_date'))
                {
                    $table->dateTime('subscription_date')->change();
                }
            });
        }
    }
}
