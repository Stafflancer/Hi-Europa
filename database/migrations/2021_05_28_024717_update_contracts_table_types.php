<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateContractsTableTypes extends Migration
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
                if (Schema::hasColumn('contracts', 'postal_code'))
                {
                    $table->integer('postal_code')->change();
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'contract_start_date'))
                {
                    $table->date('contract_start_date')->change();
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'contract_expiration_date'))
                {
                    $table->date('contract_expiration_date')->change();
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'dependance_postal_code'))
                {
                    $table->integer('dependance_postal_code')->change();
                }
            });

            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'moving_out_of_home'))
                {
                    $table->dropColumn('moving_out_of_home');
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'insurer_name'))
                {
                    $table->dropColumn('insurer_name');
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'insured_name'))
                {
                    $table->dropColumn('insured_name');
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'insurance_contract_number'))
                {
                    $table->dropColumn('insurance_contract_number');
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'duration_contract'))
                {
                    $table->dropColumn('duration_contract');
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'live_home_insure'))
                {
                    $table->dropColumn('live_home_insure');
                }
            });

            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'insurance_date'))
                {
                    $table->dropColumn('insurance_date');
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (!Schema::hasColumn('contracts', 'transfer_date'))
                {
                    $table->enum('transfer_date', ['5', '10', '15'])->nullable();
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
                if (Schema::hasColumn('contracts', 'postal_code'))
                {
                    $table->string('postal_code')->change();
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'contract_start_date'))
                {
                    $table->string('contract_start_date')->change();
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'contract_expiration_date'))
                {
                    $table->string('contract_expiration_date')->change();
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'dependance_postal_code'))
                {
                    $table->string('dependance_postal_code')->change();
                }
            });

            Schema::table('contracts', function (Blueprint $table) {
                if (!Schema::hasColumn('contracts', 'moving_out_of_home'))
                {
                    $table->string('moving_out_of_home');
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (!Schema::hasColumn('contracts', 'insurer_name'))
                {
                    $table->string('insurer_name');
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (!Schema::hasColumn('contracts', 'insured_name'))
                {
                    $table->string('insured_name');
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (!Schema::hasColumn('contracts', 'insurance_contract_number'))
                {
                    $table->string('insurance_contract_number');
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (!Schema::hasColumn('contracts', 'duration_contract'))
                {
                    $table->string('duration_contract');
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (!Schema::hasColumn('contracts', 'live_home_insure'))
                {
                    $table->string('live_home_insure');
                }
            });

            Schema::table('contracts', function (Blueprint $table) {
                if (!Schema::hasColumn('contracts', 'insurance_date'))
                {
                    $table->string('insurance_date');
                }
            });
            Schema::table('contracts', function (Blueprint $table) {
                if (Schema::hasColumn('contracts', 'transfer_date'))
                {
                    $table->dropColumn('transfer_date');
                }
            });
        }
    }
}
