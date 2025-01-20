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
        Schema::create('property_submissions', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('user_last')->nullable();
            $table->string('user_first')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('sender_type')->nullable();
            $table->string('property_name')->nullable();
            $table->string('property_type')->nullable();
            $table->string('property_unit_status')->nullable();
            $table->decimal('property_price', 50, 2)->nullable();
            $table->decimal('property_area', 50, 2)->nullable();
            $table->string('property_number')->nullable();
            $table->boolean('property_parking')->nullable();
            $table->string('property_status')->nullable();
            $table->string('property_rent_terms')->nullable();
            $table->string('property_sale_type')->nullable();
            $table->string('property_sale_payment')->nullable();
            $table->string('property_sale_title')->nullable();
            $table->string('property_sale_turnover')->nullable();
            $table->string('property_description')->nullable();
            $table->json('property_amenities')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_submissions');
    }
};
