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
    Schema::create('team_members', function (Blueprint $table) {
        $table->id();

        $table->string('name');

        $table->string('position');

        $table->string('department')
            ->nullable();

        $table->text('description')
            ->nullable();

        $table->string('photo')
            ->nullable();

        $table->string('email')
            ->nullable();

        $table->string('phone')
            ->nullable();

        $table->string('linkedin_url')
            ->nullable();

        $table->string('facebook_url')
            ->nullable();

        $table->string('instagram_url')
            ->nullable();

        $table->unsignedInteger('display_order')
            ->default(0)
            ->index();

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
        Schema::dropIfExists('team_members');
    }
};
