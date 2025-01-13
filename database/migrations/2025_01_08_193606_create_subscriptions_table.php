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
    Schema::create('subscriptions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('student_id'); // Must match the data type of students.id
        $table->date('start_date');
        $table->date('end_date');
        $table->boolean('is_active')->default(true);
        $table->timestamps();

        // Add foreign key constraint
        $table->foreign('student_id')
              ->references('id')
              ->on('students')
              ->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
