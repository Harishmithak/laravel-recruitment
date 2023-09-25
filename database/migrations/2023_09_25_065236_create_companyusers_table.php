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
        Schema::create('companyusers', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_email')->unique(); 
            $table->timestamp('email_verified_at')->nullable();
            $table->string('company_password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companyusers');
    }
};
