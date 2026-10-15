<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('join_submissions', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email');
            $table->string('phone', 30);

            $table->enum('field', [
                'graphic',
                'structure',
                'production',
                'marketing',
                'internship',
                'other',
            ]);

            $table->string('experience')->nullable();
            $table->string('portfolio')->nullable();

            $table->string('resume')->nullable();

            $table->text('message')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('join_submissions');
    }
};