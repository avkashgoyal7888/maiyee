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
        Schema::create('users', function (Blueprint $table) {
        $table->id();   
        $table->string('name'); 
        $table->string('email')->unique();  
        $table->timestamp('email_verified_at')->nullable(); 
        $table->string('password')->nullable(); 
        $table->string('avatar')->nullable(); 
        $table->rememberToken();    
        $table->string('provider_name')->nullable(); // the social media provider (e.g. Google, Facebook)   
        $table->string('provider_id')->nullable(); // the ID of the user on the social media platform
        $table->string('number', '13')->unique()->nullable();
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
