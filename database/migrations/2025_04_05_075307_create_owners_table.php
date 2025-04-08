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
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // phone
            $table->string('phone');

            // user_id column
            $table->unsignedBigInteger('user_id'); // Define the user_id column

            // add a foreign key constraint to the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // credit
            $table->integer('credit')->default(0);
            // stripe customer id
            $table->string('stripe_customer_id')->nullable();

            // owner PIN to login to see dashboard
            $table->string('pin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
