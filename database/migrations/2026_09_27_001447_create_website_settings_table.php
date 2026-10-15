<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();

            $table->string('company_name')
                ->default('EES Technologies Ghana');

            $table->string('tagline')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->string('email')
                ->nullable();

            $table->string('phone')
                ->nullable();

            $table->string('address')
                ->nullable();

            $table->string('logo')
                ->nullable();

            $table->string('favicon')
                ->nullable();

            $table->string('facebook_url')
                ->nullable();

            $table->string('instagram_url')
                ->nullable();

            $table->string('linkedin_url')
                ->nullable();

            $table->string('twitter_url')
                ->nullable();

            $table->string('status')
                ->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};