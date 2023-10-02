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
        Schema::create('experiendetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->unsignedBigInteger('academic_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('job_id');
            $table->integer('year_of_experience');  
            $table->string('previous_company_name');
            $table->string('previous_job_position');
            $table->timestamps();
            $table->foreign('candidate_id')->references('id')->on('candidatedetails')->onDelete('cascade');
            $table->foreign('academic_id')->references('id')->on('academicdetails')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companyusers')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiendetails');
    }
};
