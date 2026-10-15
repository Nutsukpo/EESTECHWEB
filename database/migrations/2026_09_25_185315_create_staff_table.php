<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Staff Identification
            |--------------------------------------------------------------------------
            */

            $table->string('staff_id', 50)->unique();


            /*
            |--------------------------------------------------------------------------
            | Personal Information
            |--------------------------------------------------------------------------
            */

            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_name')->nullable();

            $table->string('gender', 30)->nullable();

            $table->date('date_of_birth')->nullable();

            $table->text('address')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Contact Information
            |--------------------------------------------------------------------------
            */

            $table->string('email')->unique();

            $table->string('phone', 50)->nullable();


            /*
            |--------------------------------------------------------------------------
            | Employment Information
            |--------------------------------------------------------------------------
            */

            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            $table->string('position');

            $table->decimal('salary', 12, 2)->nullable();

            $table->date('employment_date')->nullable();

            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active')->index();


            /*
            |--------------------------------------------------------------------------
            | Profile
            |--------------------------------------------------------------------------
            */

            $table->string('profile_photo')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Optional System User Account
            |--------------------------------------------------------------------------
            |
            | Allows a staff member to later be connected to a User account.
            |
            */

            $table->foreignId('user_id')
                ->nullable()
                ->unique()
                ->constrained('users')
                ->nullOnDelete();


            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};