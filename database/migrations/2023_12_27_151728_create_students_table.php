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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('grade_id')->nullable()->constrained('grades')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('set null')->onUpdate('cascade');
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('institute')->nullable();
            $table->string('expected_tution_fee')->nullable();
            $table->text('major_subjects')->nullable();
            $table->string('preferred_shift')->nullable();
            $table->time('preferred_time_start')->nullable();
            $table->time('preferred_time_end')->nullable();
            $table->text('additional_info')->nullable();
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
        Schema::dropIfExists('students');
    }
};