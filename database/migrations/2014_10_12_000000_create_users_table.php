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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('code', 30);
            $table->tinyInteger('type')->default(3)->comment("1: Admin; 2: Teacher; 3: Student");
            $table->string('source', 30)->default('normal')->comment("like normal, facebook, google");
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('first_name', 30)->nullable();
            $table->string('middle_name', 120)->nullable();
            $table->string('last_name', 30)->nullable();
            $table->string('username');
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('email', 180)->nullable();
            $table->boolean('email_verfified')->default(0);
            $table->timestamp('email_verified_at', 6)->nullable();
            $table->string('mobile', 10)->nullable();
            $table->boolean('mobile_verified')->default(0);
            $table->timestamp('mobile_verified_at', 6)->nullable();
            $table->string('avatar')->nullable();
            $table->string('referrer_url')->nullable();
            $table->tinyInteger('status')->default(1)->comment("1: Active; 2: Inactive; 3: Suspended");
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps(6);
            $table->softDeletes('deleted_at', 6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
