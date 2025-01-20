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
        Schema::create('submissions', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('property');
            $table->string('type');
            $table->string('location');
            $table->decimal('price', 50, 2);
            $table->integer('area');
            $table->boolean('parking');
            $table->boolean('vacant')->nullable();
            $table->text('description');
            $table->string('sale');
            $table->string('badge');
            $table->string('status');
            $table->string('submit_status');
            $table->string('unit_number')->nullable();
            $table->string('unit_type');
            $table->string('unit_furnish');
            $table->string('unit_floor')->nullable();
            $table->string('submitted_by')->nullable();
            $table->boolean('commission');
            $table->string('terms')->nullable();
            $table->string('title')->nullable();
            $table->date('turnover')->nullable();
            $table->string('lease');
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
        Schema::dropIfExists('submissions');
    }
};
