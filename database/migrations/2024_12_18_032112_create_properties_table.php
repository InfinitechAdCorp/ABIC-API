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
        Schema::create('properties', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('owner_id');
            $table->string('name');
            $table->string('location');
            $table->decimal('price', 50, 2);
            $table->decimal('area', 50, 2);
            $table->boolean('parking');
            $table->string('description');

            $table->string('unit_number');
            $table->string('unit_type');
            $table->string('unit_status');
            
            $table->string('title');
            $table->string('payment');
            $table->string('turnover');
            $table->string('terms');

            $table->string('type');
            $table->boolean('published');

            $table->json('amenities');
            $table->json('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
