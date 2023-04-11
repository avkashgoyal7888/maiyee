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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code');
            $table->enum('coupon_type', ['amount', '%']);
            $table->double('coupon_price', 10,2)->default(0.00);
            $table->date('used_date')->nullable();
            $table->enum('status', ['0', '1'])->default('0');
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('admins');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
