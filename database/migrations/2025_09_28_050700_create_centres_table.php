<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('centres', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('type');
            $table->string('name');
            $table->string('code');
            $table->longText('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('contact_person');
            $table->string('mobile');
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email');
            $table->string('description')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('password');
            $table->string('chairman_signature')->nullable();
            $table->string('examiner_signature')->nullable();
            $table->string('center_logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centres');
    }
};
