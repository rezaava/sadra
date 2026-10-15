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
        Schema::create('free_sample_requests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');      
            $table->string('mobile');          
            $table->string('brand');           
            $table->unsignedInteger('num'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_sample_requests');
    }
};