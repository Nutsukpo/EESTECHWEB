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
    Schema::create('company_contacts', function (Blueprint $table) {
        $table->id();

        // Company contact information
        $table->string('company_name')->default('EES Technologies Ghana');
        $table->string('primary_phone')->nullable();
        $table->string('secondary_phone')->nullable();
        $table->string('email')->nullable();
        $table->string('secondary_email')->nullable();

        // Office location
        $table->string('address')->nullable();
        $table->string('city')->nullable();
        $table->string('region')->nullable();
        $table->string('country')->default('Ghana');
        $table->text('google_maps_embed')->nullable();
        $table->string('google_maps_url', 2048)->nullable();

        // Working hours
        $table->string('weekday_hours')->nullable();
        $table->string('saturday_hours')->nullable();
        $table->string('sunday_hours')->nullable();

        // Social media links
        $table->string('linkedin_url', 2048)->nullable();
        $table->string('facebook_url', 2048)->nullable();
        $table->string('instagram_url', 2048)->nullable();
        $table->string('x_url', 2048)->nullable();

        // Publication settings
        $table->boolean('is_published')->default(false)->index();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_contacts');
    }
};
