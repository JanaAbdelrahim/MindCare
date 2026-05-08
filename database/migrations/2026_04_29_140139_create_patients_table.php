<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
                $table->id();
                $table->string('email')->unique();
                $table->string('password');
                $table->string('first_name');
                $table->string('last_name');
                $table->unsignedInteger('age')->nullable();
                $table->string('condition_level')->nullable();
                $table->decimal('wallet', 10, 2)->default(0.00);
                $table->foreignId('therapist_id')->nullable()->constrained('therapists')->onDelete('set null');
                $table->integer('total_sessions')->default(0);
                $table->date('date_of_birth')->nullable();
                $table->string('gender')->nullable();
                $table->timestamps();
        }); 
    }


    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
