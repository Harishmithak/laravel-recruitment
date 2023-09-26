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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->default(1);
            $table->string('company_name')->default(1);
            $table->string('job_position');
            $table->text('job_description');
            $table->string('basic_qualification');
            $table->text('skills_required');
            $table->date('application_start_date')->default(now()); 
            $table->date('application_end_date')->default(now()->addDays(30));
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('company_id')->references('id')->on('companyusers')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
