<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personal_quotes', function (Blueprint $table) {
            $table->text('license_files')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('personal_quotes', function (Blueprint $table) {
            $table->string('license_files', 255)->nullable()->change();
        });
    }
};
