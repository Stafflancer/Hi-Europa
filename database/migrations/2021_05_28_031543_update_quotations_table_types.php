<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateQuotationsTableTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('quotations'))
        {
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'type_accommodation'))
                {
                    $table->dropColumn('type_accommodation');
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (!Schema::hasColumn('quotations', 'type_accommodation'))
                {
                    $table->enum('type_accommodation', ['Maison', 'Appartement'])->nullable();
                }
            });

            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'prospect_type'))
                {
                    $table->dropColumn('prospect_type');
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (!Schema::hasColumn('quotations', 'prospect_type'))
                {
                    $table->enum('prospect_type', ['Proprietaire', 'Locataire', 'Colocataire'])->nullable();
                }
            });

            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'type_residence'))
                {
                    $table->dropColumn('type_residence');
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (!Schema::hasColumn('quotations', 'type_residence'))
                {
                    $table->enum('type_residence', ['Principale', 'Secondaire'])->nullable();
                }
            });

            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'apartment_floor'))
                {
                    $table->dropColumn('apartment_floor');
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (!Schema::hasColumn('quotations', 'apartment_floor'))
                {
                    $table->enum('apartment_floor', ['Rez_de_chaussee', 'Intermediaire', 'Dernier_etage'])->nullable();
                }
            });

            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'apartment_surface'))
                {
                    $table->decimal('apartment_surface')->change();
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'franchise'))
                {
                    $table->decimal('franchise')->default(0)->change();
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'furniture_capital'))
                {
                    $table->decimal('furniture_capital')->default(0)->change();
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'total_value_furniture_400'))
                {
                    $table->decimal('total_value_furniture_400')->default(0)->change();
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'total_value_furniture_1800'))
                {
                    $table->decimal('total_value_furniture_1800')->default(0)->change();
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'estimated_coverage'))
                {
                    $table->decimal('estimated_coverage')->default(0)->change();
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'cost_month'))
                {
                    $table->decimal('cost_month')->default(0)->change();
                }
            });

            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'precision_tree'))
                {
                    $table->dropColumn('precision_tree');
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'living_room'))
                {
                    $table->dropColumn('living_room');
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'library'))
                {
                    $table->dropColumn('library');
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'mezzanine'))
                {
                    $table->dropColumn('mezzanine');
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'protect_legal'))
                {
                    $table->dropColumn('protect_legal');
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
        if (Schema::hasTable('quotations'))
        {
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'type_accommodation'))
                {
                    $table->dropColumn('type_accommodation');
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (!Schema::hasColumn('quotations', 'type_accommodation'))
                {
                    $table->string('type_accommodation');
                }
            });

            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'prospect_type'))
                {
                    $table->dropColumn('prospect_type');
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (!Schema::hasColumn('quotations', 'prospect_type'))
                {
                    $table->string('prospect_type');
                }
            });

            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'type_residence'))
                {
                    $table->dropColumn('type_residence');
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (!Schema::hasColumn('quotations', 'type_residence'))
                {
                    $table->string('type_residence');
                }
            });

            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'apartment_floor'))
                {
                    $table->dropColumn('apartment_floor');
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (!Schema::hasColumn('quotations', 'apartment_floor'))
                {
                    $table->string('apartment_floor');
                }
            });

            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'apartment_surface'))
                {
                    $table->string('apartment_surface')->change();
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'franchise'))
                {
                    $table->integer('franchise')->default(0)->change();
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'furniture_capital'))
                {
                    $table->integer('furniture_capital')->default(0)->change();
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'total_value_furniture_400'))
                {
                    $table->integer('total_value_furniture_400')->default(0)->change();
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'total_value_furniture_1800'))
                {
                    $table->integer('total_value_furniture_1800')->default(0)->change();
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'estimated_coverage'))
                {
                    $table->integer('estimated_coverage')->default(0)->change();
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (Schema::hasColumn('quotations', 'cost_month'))
                {
                    $table->unsignedBigInteger('cost_month')->default(0)->change();
                }
            });

            Schema::table('quotations', function (Blueprint $table) {
                if (!Schema::hasColumn('quotations', 'precision_tree'))
                {
                    $table->string('precision_tree');
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (!Schema::hasColumn('quotations', 'living_room'))
                {
                    $table->integer('living_room')->default(0);
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (!Schema::hasColumn('quotations', 'library'))
                {
                    $table->integer('library')->default(0);
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (!Schema::hasColumn('quotations', 'mezzanine'))
                {
                    $table->integer('mezzanine')->default(0);
                }
            });
            Schema::table('quotations', function (Blueprint $table) {
                if (!Schema::hasColumn('quotations', 'protect_legal'))
                {
                    $table->boolean('protect_legal')->default(true);
                }
            });
        }
    }
}
