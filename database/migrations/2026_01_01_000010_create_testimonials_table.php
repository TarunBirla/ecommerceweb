<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_title')->nullable(); // e.g. Chief Procurement Officer, PetChem Corp
            $table->string('client_avatar')->nullable();
            $table->string('company_name')->nullable();
            $table->text('content');
            $table->integer('rating')->default(5);
            $table->boolean('is_featured')->default(true);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
