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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('genre')->nullable();
            $table->integer('release_year')->nullable();
            $table->string('language')->nullable();
            $table->string('poster_url')->nullable();
            $table->string('download_link');
            $table->string('file_size')->nullable();
            $table->string('quality')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('downloads')->default(0);
            $table->timestamps();
            
            // Add indexes for better performance
            $table->index(['genre', 'release_year']);
            $table->index('slug');
            $table->index(['is_active', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
