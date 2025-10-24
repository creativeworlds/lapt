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
            $table->string('name');
            $table->string('code');
            $table->foreignId('centre_category_id')->constrained()->cascadeOnDelete();
            $table->integer('type');
            $table->longText('address');
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->foreignId('state_id')->constrained()->cascadeOnDelete();
            $table->string('currency');
            $table->string('tax_type');
            $table->string('gst_number')->nullable();
            $table->string('preferred_seller');
            $table->string('gst_mode')->nullable();
            $table->string('city');
            $table->string('contact_person');
            $table->string('mobile');
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email');
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('password');
            $table->string('chairman_sign')->nullable();
            $table->string('examiner_sign')->nullable();
            $table->string('logo')->nullable();
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
