<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableTypes extends Migration
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
                if (Schema::hasColumn('users', 'title'))
                {
                    $table->dropColumn('title');
                }
            });
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'title'))
                {
                    $table->enum('title', ['Monsieur', 'Madame'])->nullable();
                }
            });

            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'gender'))
                {
                    $table->dropColumn('gender');
                }
            });
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'gender'))
                {
                    $table->enum('gender', ['male', 'female'])->nullable();
                }
            });

            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'birthday'))
                {
                    $table->date('birthday')->nullable()->change();
                }
            });

            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'postal_code'))
                {
                    $table->integer('postal_code')->nullable()->change();
                }
            });

            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'insurance_payed'))
                {
                    $table->dropColumn('insurance_payed');
                }
            });

            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'receive_info'))
                {
                    $table->renameColumn('receive_info', 'opt_in_hieuropa');
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
                if (Schema::hasColumn('users', 'title'))
                {
                    $table->dropColumn('title');
                }
            });
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'title'))
                {
                    $table->string('title')->nullable();
                }
            });

            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'gender'))
                {
                    $table->dropColumn('gender');
                }
            });
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'gender'))
                {
                    $table->string('gender')->nullable()->comment('male, female');
                }
            });

            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'birthday'))
                {
                    $table->string('birthday')->nullable()->change();
                }
            });

            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'postal_code'))
                {
                    $table->string('postal_code')->nullable()->change();
                }
            });

            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'insurance_payed'))
                {
                    $table->boolean('insurance_payed')->default(0);
                }
            });

            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'opt_in_hieuropa'))
                {
                    $table->renameColumn('opt_in_hieuropa', 'receive_info');
                }
            });
        }
    }
}
