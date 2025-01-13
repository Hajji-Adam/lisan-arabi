<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueConstraintToPayments extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Check if the columns already exist
            if (!Schema::hasColumn('payments', 'payment_year')) {
                $table->integer('payment_year')->virtualAs('YEAR(payment_date)');
            }

            if (!Schema::hasColumn('payments', 'payment_month')) {
                $table->integer('payment_month')->virtualAs('MONTH(payment_date)');
            }

            // Add a unique constraint on student_id, payment_year, and payment_month
            $table->unique(['student_id', 'payment_year', 'payment_month'], 'unique_payment_per_month');
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop the unique constraint
            $table->dropUnique('unique_payment_per_month');

            // Drop the virtual columns if they exist
            if (Schema::hasColumn('payments', 'payment_year')) {
                $table->dropColumn('payment_year');
            }

            if (Schema::hasColumn('payments', 'payment_month')) {
                $table->dropColumn('payment_month');
            }
        });
    }
}

