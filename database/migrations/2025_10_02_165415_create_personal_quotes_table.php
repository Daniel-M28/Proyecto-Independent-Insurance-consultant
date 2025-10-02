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
    Schema::create('personal_quotes', function (Blueprint $table) {
        $table->id();
        $table->string('name', 30);
        $table->string('lastname', 30);
        $table->date('dob');
        $table->string('email', 255);
        $table->string('phone', 20);
        $table->string('address', 100);
        $table->date('iss_date');
        $table->string('occupation', 50);
        $table->integer('miles');
        $table->string('vin', 255);
        $table->string('coverage', 50);
        $table->string('vehicle_type', 30);
        $table->string('usage', 30);
        $table->string('make', 30);
        $table->string('model', 30);
        $table->string('body_class', 30);
        $table->string('license_files')->nullable(); // guardaremos rutas separadas por coma
        $table->text('observations')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_quotes');
    }
};
