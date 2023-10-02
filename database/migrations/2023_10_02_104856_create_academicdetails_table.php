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
        Schema::create('academicdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('job_id');
            $table->string('Qualification');  
            $table->string('college_name');
            $table->integer('year_of_passing_college');
            $table->float('percentage_college');
            $table->string('school_name_tenth');
            $table->integer('year_of_passing_tenth');
            $table->float('percentage_tenth');
            $table->string('school_name_twelfth');
            $table->integer('year_of_passing_twelfth');
            $table->float('percentage_twelfth');
            $table->string('skills');
            $table->string('job_position');   

            $table->timestamps();
 
            $table->foreign('candidate_id')->references('id')->on('candidatedetails')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companyusers')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academicdetails');
    }
};
