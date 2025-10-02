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
    Schema::create('commercial_requests', function (Blueprint $table) {
        $table->id();
        $table->string('usdot', 8);
        $table->string('name', 30);
        $table->string('lastname', 30);
        $table->string('phone', 20);
        $table->string('email', 255);
        $table->string('business_address', 100);
        $table->text('vin'); // puede ser varios separados por coma
        $table->string('yard', 100)->nullable();
        $table->integer('miles')->nullable();
        $table->string('type_of_load')->nullable();
        $table->json('coverages')->nullable(); // guardamos como JSON
        $table->json('licenses')->nullable();  // guardamos nombres de archivos
        $table->text('comments')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commercial_requests');
    }
};
