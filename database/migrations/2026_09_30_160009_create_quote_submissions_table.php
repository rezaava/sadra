<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('email');
            $table->string('phone', 30);
            $table->string('category');
            $table->string('sheet');
            $table->string('packaging');
            $table->string('quantity');
            $table->string('timeline')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('file')->nullable();
            $table->text('message')->nullable();
            $table->string('tracking_code')->nullable()->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_submissions');
    }
};
