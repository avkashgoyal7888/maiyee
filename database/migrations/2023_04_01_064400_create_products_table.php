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
            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('sub_id');
            $table->foreign('sub_id')->references('id')->on('sub_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('hsn_code');
            $table->string('gst_rate');
            $table->double('mrp', 10,2)->default(0.00);
            $table->double('discount', 10,2)->default(0.00);
            $table->longText('detail');
            $table->longText('description');
            $table->string('image');
            $table->timestamps();
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
