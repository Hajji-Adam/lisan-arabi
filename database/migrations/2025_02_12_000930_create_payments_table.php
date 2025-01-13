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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->onDelete('cascade'); // Link to students
        $table->date('payment_date'); // Date of payment
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('payments');
}
};
