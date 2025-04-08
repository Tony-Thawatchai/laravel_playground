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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // FK to customer_id that one membership can only belong to one customer
            // customer_id column
            $table->unsignedBigInteger('customer_id'); // Define the customer_id column
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            // FK to restaurant_id that one membership can only belong to one restaurant
            // restaurant_id column
            $table->unsignedBigInteger('restaurant_id'); // Define the restaurant_id column
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            // points
            $table->integer('points')->default(0);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
