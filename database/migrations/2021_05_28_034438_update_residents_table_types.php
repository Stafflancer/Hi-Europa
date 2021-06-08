<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateResidentsTableTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('residents'))
        {
            Schema::table('residents', function (Blueprint $table) {
                if (Schema::hasColumn('residents', 'title'))
                {
                    $table->dropColumn('title');
                }
            });
            Schema::table('residents', function (Blueprint $table) {
                if (!Schema::hasColumn('residents', 'title'))
                {
                    $table->enum('title', ['Monsieur', 'Madame'])->nullable();
                }
            });

            Schema::table('residents', function (Blueprint $table) {
                if (Schema::hasColumn('residents', 'status'))
                {
                    $table->dropColumn('status');
                }
            });
            Schema::table('residents', function (Blueprint $table) {
                if (!Schema::hasColumn('residents', 'status'))
                {
                    $table->enum('status', ['Conjoint', 'Enfant', 'Colocataire', 'Parent', 'Autre'])->nullable();
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
        if (Schema::hasTable('residents'))
        {
            Schema::table('residents', function (Blueprint $table) {
                if (Schema::hasColumn('residents', 'title'))
                {
                    $table->dropColumn('title');
                }
            });
            Schema::table('residents', function (Blueprint $table) {
                if (!Schema::hasColumn('residents', 'title'))
                {
                    $table->string('title');
                }
            });

            Schema::table('residents', function (Blueprint $table) {
                if (Schema::hasColumn('residents', 'status'))
                {
                    $table->dropColumn('status');
                }
            });
            Schema::table('residents', function (Blueprint $table) {
                if (!Schema::hasColumn('residents', 'status'))
                {
                    $table->string('status');
                }
            });
        }
    }
}
