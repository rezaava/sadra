<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('representative_requests', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('نام و نام خانوادگی');
            $table->string('city')->comment('شهر / استان');
            $table->string('phone')->comment('شماره تماس');
            $table->string('email')->comment('ایمیل');

            $table->enum('type', [
                'sales',
                'online',
                'regional',
                'other',
            ])->comment('نوع همکاری');

            $table->text('message')->nullable()->comment('توضیحات');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('representative_requests');
    }
};