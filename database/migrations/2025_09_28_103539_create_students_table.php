<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('centre_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('care_of');
            $table->string('sex');
            $table->string('session');
            $table->string('photo')->nullable();
            $table->string('id_card')->nullable();
            $table->string('education_proof')->nullable();
            $table->string('other_doc')->nullable();
            $table->string('qualification');
            $table->string('telephone')->nullable();
            $table->string('email');
            $table->string('mobile');
            $table->string('fax')->nullable();
            $table->text('address_line')->nullable();
            $table->text('details')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};