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
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ideal');
            $table->string('length_type');
            $table->string('brand_color');
            $table->string('ocassion');
            $table->string('pattern');
            $table->string('type');
            $table->string('fabric');
            $table->string('neck');
            $table->string('sleeve');
            $table->string('color');
            $table->string('sale_package');
            $table->string('fabric_care');
            $table->string('style_code');
            $table->timestamps();
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
