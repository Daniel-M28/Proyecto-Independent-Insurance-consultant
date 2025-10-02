<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personal_quotes', function (Blueprint $table) {
            // Cambiamos el campo a JSON
            $table->json('license_files')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('personal_quotes', function (Blueprint $table) {
            // Lo devolvemos a TEXT en caso de rollback
            $table->text('license_files')->nullable()->change();
        });
    }
};
