<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('student_courses', function (Blueprint $table) {
            $table->date('registration_date')->useCurrent();
            $table->string('payment')->nullable();
            $table->string('payment_status')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('course_status')->nullable();
            $table->string('status')->nullable();
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_courses', function (Blueprint $table) {
            $table->dropColumn([
                'registration_date',
                'payment',
                'payment_status',
                'start_date',
                'end_date',
                'course_status',
                'status'
            ]);
            $table->timestamps();
        });
    }
};