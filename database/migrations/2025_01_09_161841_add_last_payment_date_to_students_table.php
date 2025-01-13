<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('students', function (Blueprint $table) {
        $table->date('last_payment_date')->nullable(); // Track the last payment date
    });
}

public function down()
{
    Schema::table('students', function (Blueprint $table) {
        $table->dropColumn('last_payment_date');
    });
}
};
