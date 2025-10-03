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
    Schema::create('companies', function (Blueprint $table) {
        $table->id();
        $table->string('company_name_1', 60);
        $table->string('company_name_2', 60);
        $table->string('company_name_3', 60);
        $table->string('owner_first_name', 50);
        $table->string('owner_last_name', 50);
        $table->string('ssn', 11);
        $table->date('dob');
        $table->string('phone', 20);
        $table->string('email', 255);
        $table->string('business_address', 100);
        $table->string('cargo_type');
        $table->string('operation_type');
        $table->string('vehicle_type');
        $table->text('observations')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
