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
        Schema::create('variations', function (Blueprint $table) {
            $table->id(); 
            $table->string('product_id'); 
            $table->string('type')->nullable();
            $table->string('value')->nullable();
            $table->string('hex_value')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamps();
        
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variations');
    }
};
