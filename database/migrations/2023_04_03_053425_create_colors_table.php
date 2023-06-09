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
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->string('code');
            $table->string('image');
            $table->enum('color_category', ['black', 'white', 'blue', 'pink', 'purple', 'beige', 'brown', 'off_white', 'gold', 'green', 'grey', 'khaki', 'maroon', 'red', 'multi_color', 'orange', 'silver', 'yellow', 'teal', 'wine', 'turquoise']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colors');
    }
};
