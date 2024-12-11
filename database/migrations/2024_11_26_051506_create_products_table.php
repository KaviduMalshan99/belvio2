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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->unique();
            $table->string('product_name');
            $table->text('product_description')->nullable();
            $table->unsignedBigInteger('category_id'); 
            $table->unsignedBigInteger('subcategory_id')->nullable(); 
            $table->unsignedBigInteger('sub_subcategory_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('tags')->nullable();
            $table->decimal('normal_price', 8, 2);
            $table->timestamps();
        
            // Define the foreign key constraints
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('set null'); 
            $table->foreign('sub_subcategory_id')->references('id')->on('sub_subcategories')->onDelete('set null'); 
        });
        
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
