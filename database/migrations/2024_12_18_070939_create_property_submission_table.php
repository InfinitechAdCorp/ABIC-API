<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('property_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('user_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('name');
            $table->string('unit_type');
            $table->string('location');
            $table->decimal('min_price', 10, 2);
            $table->decimal('max_price', 10, 2);
            $table->string('status');
            $table->json('images');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_submission');
    }
};
