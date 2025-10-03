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
        Schema::create('new_companies', function (Blueprint $table) {
            $table->id();
            
            $table->string('company_name_1', 60);
            $table->string('company_name_2', 60);
            $table->string('company_name_3', 60);
            $table->string('owner_first_name', 50);
            $table->string('owner_last_name', 50);
            $table->string('ssn', 11);
            $table->date('dob');
            $table->json('licenses')->nullable();
            $table->string('phone', 20);
            $table->string('email', 255);
            $table->string('business_address', 100);
            $table->string('cargo_type', 50);
            $table->string('operation_type', 50);
            $table->string('vehicle_type', 50);
            $table->text('observations')->nullable();
            
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_companies');
    }
};
