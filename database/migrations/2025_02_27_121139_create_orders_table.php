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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->decimal('subtotal');
            $table->string('coupon_code')->nullable();
            $table->decimal('discount')->default('0');
            $table->decimal('tax');
            $table->decimal('total');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->string('city');
            $table->string('country');
            $table->string('zip');
            $table->text('customer_note')->nullable();
            $table->enum('status', ['ordered', 'delivered', 'canceled'])->default('ordered');
            $table->date('delivered_date')->nullable();
            $table->date('canceled_date')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
