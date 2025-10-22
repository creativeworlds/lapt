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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->enum('invoice_type', ['student', 'accreditation']);
            $table->foreignId('centre_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->decimal('discount', 5, 2)->default(0.00);
            $table->decimal('fee_after_discount', 10, 2);
            $table->string('currency')->nullable();
            $table->decimal('tax', 5, 2)->default(0.00);
            $table->decimal('final_amount', 10, 2)->default(0.00);
            $table->integer('quantity')->default(1);
            $table->date('due_date');
            $table->string('emi', 1)->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};