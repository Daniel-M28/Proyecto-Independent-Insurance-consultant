<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factorings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('last_name', 30);
            $table->string('email', 255);
            $table->string('phone_number', 20);
            $table->string('observations', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factorings');
    }
};
