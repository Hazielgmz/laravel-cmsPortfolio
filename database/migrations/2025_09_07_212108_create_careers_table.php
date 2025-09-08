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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->text('position');         // Job position or title
            $table->text('company');          // Company name
            $table->text('period');           // Time period (e.g. "2023-2025" or "January 2023 - Present")
            $table->text('description');      // Job responsibilities and achievements
            $table->text('contact')->nullable(); // Company contact information (optional)
            $table->boolean('visible')->default(false); // To control visibility in the portfolio
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
