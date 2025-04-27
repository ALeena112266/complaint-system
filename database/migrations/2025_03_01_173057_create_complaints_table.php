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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Foreign Key
            $table->string('title'); // Complaint Title
            $table->text('description'); // Complaint Description
            $table->enum('status', ['pending', 'in progress', 'rejected', 'resolved'])->default('pending'); // Status
            $table->enum('priority', ['high', 'medium', 'low'])->default('low'); // Priority
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
