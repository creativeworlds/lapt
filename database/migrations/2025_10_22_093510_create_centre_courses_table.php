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
        Schema::create('centre_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('centre_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->decimal('fee', 10, 2)->default(0.00);
            $table->decimal('discount', 5, 2)->default(0.00);
            $table->decimal('fee_after_discount', 10, 2)->default(0.00);
            $table->string('currency')->nullable();
            $table->string('tax_type')->nullable();
            $table->decimal('tax_rate', 5, 2)->default(0.00);
            $table->decimal('tax_amount_included', 10, 2)->default(0.00);
            $table->decimal('amount_ex_tax', 10, 2)->default(0.00);
            $table->string('gst_mode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centre_courses');
    }
};