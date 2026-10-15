<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Content
            |--------------------------------------------------------------------------
            */

            $table->string('badge')->nullable();

            $table->string('title');

            $table->string('highlight')->nullable();

            $table->text('description')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Image
            |--------------------------------------------------------------------------
            */

            $table->string('image');


            /*
            |--------------------------------------------------------------------------
            | Buttons
            |--------------------------------------------------------------------------
            */

            $table->string('primary_button_text')->nullable();

            $table->string('primary_button_url')->nullable();

            $table->string('secondary_button_text')->nullable();

            $table->string('secondary_button_url')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Slideshow Settings
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('display_order')
                ->default(0)
                ->index();

            $table->unsignedInteger('duration')
                ->default(5000);

            $table->boolean('is_active')
                ->default(true)
                ->index();


            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};