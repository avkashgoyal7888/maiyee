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
        Schema::create('link_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number');
            $table->enum('size', ['XS', 'S', 'M', 'L', 'XL','2XL','3XL','4XL','5XL']);
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_users');
    }
};
