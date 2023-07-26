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
        Schema::create('link_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('link_id');
            $table->foreign('link_id')->references('id')->on('link_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('product_name',50);
            $table->string('style_code',30);
            $table->double('mrp', 10,2)->default(0.00);
            $table->double('selling_price', 10,2)->default(0.00);
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_products');
    }
};
