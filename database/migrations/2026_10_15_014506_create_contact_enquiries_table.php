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
    Schema::create('contact_enquiries', function (Blueprint $table) {
        $table->id();

        $table->string('company_name')->nullable();
        $table->string('contact_name');
        $table->string('email');
        $table->string('phone', 50)->nullable();
        $table->string('subject')->nullable();
        $table->text('message');

        $table->string('status')->default('new')->index();
        $table->timestamp('read_at')->nullable();

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('contact_enquiries');
}

};
