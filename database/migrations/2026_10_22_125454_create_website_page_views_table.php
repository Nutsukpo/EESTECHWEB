
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_page_views', function (Blueprint $table) {
            $table->id();

            // Anonymous visitor and browser session identifiers
            $table->string('visitor_id', 64)->index();
            $table->string('session_id', 100)->nullable()->index();

            // Requested public page
            $table->string('path', 2048);
            $table->string('page_title', 255)->nullable();

            // Traffic source
            $table->string('referrer', 2048)->nullable();
            $table->string('traffic_source', 50)->default('direct')->index();

            // Basic device classification
            $table->string('device_type', 30)->default('unknown');

            // Timestamp of the page view
            $table->timestamp('viewed_at')->index();

            $table->timestamps();

            $table->index(['path', 'viewed_at']);
            $table->index(['visitor_id', 'viewed_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_page_views');
    }
};
