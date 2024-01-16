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
        Schema::create('request_tutors', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedTinyInteger('status')->default(1);
            $table->date('approved_date')->nullable();
            $table->double('tution_fee')->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_tutors');
    }
};
