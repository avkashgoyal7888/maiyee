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
            $table->integer('order_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('contact', 13);
            $table->string('email', 50);
            $table->date('order_date');
            $table->string('address');
            $table->string('landmark');
            $table->string('state');
            $table->string('city');
            $table->longText('order_notes')->nullable();
            $table->double('taxable', 10,2)->default(0.00);
            $table->double('cgst', 10,2)->default(0.00);
            $table->double('sgst', 10,2)->default(0.00);
            $table->double('igst', 10,2)->default(0.00);
            $table->double('total', 10,2)->default(0.00);
            $table->double('discount', 10,2)->default(0.00);
            $table->string('coupon_code')->nullable();
            $table->double('shipping_charges', 10,2)->default(0.00);
            $table->double('payable', 10,2)->default(0.00);
            $table->string('payment_method');
            $table->enum('order_status', ['placed', 'dispatched', 'delivered']);
            $table->timestamps();
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
