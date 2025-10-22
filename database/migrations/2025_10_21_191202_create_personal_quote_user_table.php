<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('personal_quote_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_quote_id')->constrained('personal_quotes')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // nullable para que pueda estar sin asesor
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_quote_user');
    }
};
