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
    Schema::create('about_pages', function (Blueprint $table) {
        $table->id();

        $table->string('title')
            ->default('Pioneering the next wave of digital innovation.');

        $table->string('subtitle')
            ->nullable();

        $table->text('description')
            ->nullable();

        $table->text('description_two')
            ->nullable();

        $table->string('image')
            ->nullable();

        $table->string('mission_title')
            ->default('Our Mission');

        $table->text('mission')
            ->nullable();

        $table->string('vision_title')
            ->default('Our Vision');

        $table->text('vision')
            ->nullable();

        $table->boolean('is_active')
            ->default(true)
            ->index();

        $table->timestamps();

        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};

