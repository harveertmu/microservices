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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key referencing the products table
            $table->text('description')->nullable(); // Product description
            $table->string('color')->nullable(); // Product color
            $table->string('size')->nullable(); // Product size
            $table->decimal('weight', 8, 2)->nullable(); // Product weight
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
