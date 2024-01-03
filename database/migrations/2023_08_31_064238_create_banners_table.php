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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('title');
            $table->string('slug');
            $table->tinyInteger('type')->default(0)->comment("0:image; 1:video");
            $table->string('prefix_title')->nullable();
            $table->string('suffix_title')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->tinyText('video_url')->nullable();
            $table->boolean('show_title')->default(1);
            $table->boolean('show_prefix_title')->default(1);
            $table->boolean('show_suffix_title')->default(1);
            $table->boolean('show_description')->default(1);
            $table->tinyText('url')->nullable();
            $table->tinyInteger('target')->default(0)->comment("0:Self ; 1:Blank");
            $table->string('button_text')->nullable();
            $table->boolean('show_button')->default(1);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('banners');
    }
};
