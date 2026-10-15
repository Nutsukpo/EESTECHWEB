<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Basic project information
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->nullable();
            $table->string('client_name')->nullable();

            // Project descriptions
            $table->string('short_description', 500)->nullable();
            $table->longText('description')->nullable();
            $table->longText('challenge')->nullable();
            $table->longText('solution')->nullable();
            $table->longText('results')->nullable();

            // Technologies used, stored as a JSON array
            $table->json('technologies')->nullable();

            // Project media and external link
            $table->string('cover_image')->nullable();
            $table->string('project_url')->nullable();

            // Publication and display controls
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_published')->default(false)->index();
            $table->unsignedInteger('display_order')->default(0)->index();
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
