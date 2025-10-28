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
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('theme');
            $table->string('style')->nullable();
            $table->text('content')->nullable();
            $table->string('voice_file_path')->nullable();
            $table->string('video_file_path')->nullable();
            $table->string('pdf_file_path')->nullable();
            $table->enum('status', ['draft', 'processing', 'completed', 'failed'])->default('draft');
            $table->json('settings')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
