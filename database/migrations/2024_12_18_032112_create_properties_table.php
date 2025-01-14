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
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('location')->nullable();
            $table->decimal('price', 50, 2)->nullable();
            $table->integer('area')->nullable();
            $table->boolean('parking')->nullable();
            $table->boolean('vacant')->nullable();
            $table->text('nearby')->nullable();
            $table->text('description')->nullable();
            $table->string('sale')->nullable();
            $table->string('badge')->nullable();
            $table->string('status')->nullable();
            $table->string('unit_number')->nullable();
            $table->string('unit_type')->nullable();
            $table->string('unit_furnish')->nullable();
            $table->string('unit_floor')->nullable();
            $table->json('amenities')->nullable();
            $table->json('images')->nullable();
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
