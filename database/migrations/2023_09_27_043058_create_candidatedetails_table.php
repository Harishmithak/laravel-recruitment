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
        Schema::create('candidatedetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('job_id');
            $table->string('name');
            $table->string('email');
            $table->date('dob');
            $table->string('candidate_image')->nullable();
            $table->string('signature_image')->nullable();
            $table->string('resume')->nullable();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companyusers')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatedetails');
    }
};
