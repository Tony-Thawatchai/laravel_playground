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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('address');
            // zip code
            $table->string('zip_code');
            $table->string('food_type')->nullable();
            // average bill amount
            $table->decimal('average_bill_amount', 8, 2)->nullable();
            // foreign key to the owners table
            $table->foreignId('owner_id')->constrained('owners')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
