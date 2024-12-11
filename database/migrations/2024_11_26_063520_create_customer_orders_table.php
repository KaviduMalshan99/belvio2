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
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->string('phone');
            $table->string('email');
            $table->string('house_no');
            $table->string('apartment')->nullable();
            $table->string('city');
            $table->string('postal_code');
            $table->date('date');
            $table->decimal('total_cost', 15, 2);
            $table->enum('status', ['Pending', 'Accepted', 'Shipped', 'Delivered', 'Cancelled', 'Returned'])->default('Pending');
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_orders');
    }
};
