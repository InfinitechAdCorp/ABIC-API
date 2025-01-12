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
            $table->foreignUlid('user_id');
            $table->string('name');
            $table->string('type');
            $table->string('location');
            $table->decimal('price', 50, 2);
            $table->integer('area');
            $table->boolean('parking');
            $table->boolean('vacant');
            $table->text('nearby');
            $table->text('description');
            $table->string('sale');
            $table->string('badge');
            $table->string('status');
            $table->string('unit_number');
            $table->string('unit_type');
            $table->string('unit_furnish');
            $table->string('unit_floor')->nullable();
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
