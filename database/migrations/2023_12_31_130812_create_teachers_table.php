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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('institute')->nullable();
            $table->string('expected_tution_fee')->nullable();
            $table->foreignId('qualification_id')->nullable()->constrained('qualifications')->onDelete('set null')->onUpdate('cascade');
            $table->string('major_subject')->nullable();
            $table->string('teaching_experience')->nullable();
            $table->text('preferred_subjects')->nullable();
            $table->text('teaching_grade')->nullable();
            $table->string('preferred_shift')->nullable();
            $table->time('preferred_time_start')->nullable();
            $table->time('preferred_time_end')->nullable();
            $table->text('additional_info')->nullable();
            $table->string('certificate')->nullable();
            $table->string('citizenship')->nullable();
            $table->boolean('accept_term_condition')->default(false);
            $table->boolean('status')->default(1)->comment('0: Inactive; 1: Active');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};