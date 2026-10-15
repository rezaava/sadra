<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_category_id')
                ->constrained('service_categories')
                ->cascadeOnDelete();

            $table->string('name');
            $table->longText('icon');
            $table->text('description');

            $table->unsignedInteger('projects_count')->default(0);
            $table->unsignedInteger('brands_count')->default(0);
            $table->unsignedInteger('experience_years')->default(0);
            $table->unsignedInteger('industries_count')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};