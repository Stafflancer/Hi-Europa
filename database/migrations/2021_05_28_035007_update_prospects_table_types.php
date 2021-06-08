<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProspectsTableTypes extends Migration
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
                if (Schema::hasColumn('prospects', 'prospect_type'))
                {
                    $table->dropColumn('prospect_type');
                }
            });
            Schema::table('prospects', function (Blueprint $table) {
                if (!Schema::hasColumn('prospects', 'prospect_type'))
                {
                    $table->enum('prospect_type', ['Proprietaire', 'Locataire', 'Colocataire'])->nullable();
                }
            });

            Schema::table('prospects', function (Blueprint $table) {
                if (Schema::hasColumn('prospects', 'floor'))
                {
                    $table->dropColumn('floor');
                }
            });
            Schema::table('prospects', function (Blueprint $table) {
                if (!Schema::hasColumn('prospects', 'floor'))
                {
                    $table->enum('floor', ['Rez_de_chaussee', 'Intermediaire', 'Dernier_etage'])->nullable();
                }
            });

            Schema::table('prospects', function (Blueprint $table) {
                if (Schema::hasColumn('prospects', 'residence_type'))
                {
                    $table->dropColumn('residence_type');
                }
            });
            Schema::table('prospects', function (Blueprint $table) {
                if (!Schema::hasColumn('prospects', 'residence_type'))
                {
                    $table->enum('residence_type', ['Principale', 'Secondaire'])->nullable();
                }
            });
            
            Schema::table('prospects', function (Blueprint $table) {
                if (Schema::hasColumn('prospects', 'residency_type'))
                {
                    $table->dropColumn('residency_type');
                }
            });
            Schema::table('prospects', function (Blueprint $table) {
                if (!Schema::hasColumn('prospects', 'residency_type'))
                {
                    $table->enum('residency_type', ['Maison', 'Appartement'])->nullable();
                }
            });

            Schema::table('prospects', function (Blueprint $table) {
                if (Schema::hasColumn('prospects', 'surface'))
                {
                    $table->decimal('surface')->change();
                }
            });
            Schema::table('prospects', function (Blueprint $table) {
                if (Schema::hasColumn('prospects', 'live_there_time'))
                {
                    $table->date('live_there_time')->change();
                }
            });
            Schema::table('prospects', function (Blueprint $table) {
                if (Schema::hasColumn('prospects', 'insured_time'))
                {
                    $table->date('insured_time')->change();
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
                if (Schema::hasColumn('prospects', 'prospect_type'))
                {
                    $table->dropColumn('prospect_type');
                }
            });
            Schema::table('prospects', function (Blueprint $table) {
                if (!Schema::hasColumn('prospects', 'prospect_type'))
                {
                    $table->string('prospect_type');
                }
            });

            Schema::table('prospects', function (Blueprint $table) {
                if (Schema::hasColumn('prospects', 'floor'))
                {
                    $table->dropColumn('floor');
                }
            });
            Schema::table('prospects', function (Blueprint $table) {
                if (!Schema::hasColumn('prospects', 'floor'))
                {
                    $table->string('floor');
                }
            });

            Schema::table('prospects', function (Blueprint $table) {
                if (Schema::hasColumn('prospects', 'residence_type'))
                {
                    $table->dropColumn('residence_type');
                }
            });
            Schema::table('prospects', function (Blueprint $table) {
                if (!Schema::hasColumn('prospects', 'residence_type'))
                {
                    $table->string('residence_type');
                }
            });
            Schema::table('prospects', function (Blueprint $table) {
                if (Schema::hasColumn('prospects', 'residency_type'))
                {
                    $table->dropColumn('residency_type');
                }
            });
            Schema::table('prospects', function (Blueprint $table) {
                if (!Schema::hasColumn('prospects', 'residency_type'))
                {
                    $table->string('residency_type');
                }
            });

            Schema::table('prospects', function (Blueprint $table) {
                if (Schema::hasColumn('prospects', 'surface'))
                {
                    $table->integer('surface')->change();
                }
            });
            Schema::table('prospects', function (Blueprint $table) {
                if (Schema::hasColumn('prospects', 'live_there_time'))
                {
                    $table->string('live_there_time')->change();
                }
            });
            Schema::table('prospects', function (Blueprint $table) {
                if (Schema::hasColumn('prospects', 'insured_time'))
                {
                    $table->string('insured_time')->change();
                }
            });
        }
    }
}
