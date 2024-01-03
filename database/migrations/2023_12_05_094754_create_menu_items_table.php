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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('menu_items')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->boolean('is_external')->default(0);
            $table->boolean('link_target')->default(0);
            $table->string('link_url')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1)->comment('0: Inactive; 1: Active');
            $table->integer('display_order')->default(0);
            $table->integer('type')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
