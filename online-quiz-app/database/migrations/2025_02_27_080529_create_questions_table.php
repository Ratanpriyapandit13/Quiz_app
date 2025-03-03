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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_text');
            $table->foreignId('option_1')->constrained('answers')->onDelete('cascade');
            $table->foreignId('option_2')->constrained('answers')->onDelete('cascade');
            $table->foreignId('option_3')->constrained('answers')->onDelete('cascade');
            $table->foreignId('option_4')->constrained('answers')->onDelete('cascade');
            $table->foreignId('correct_option')->constrained('answers')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
