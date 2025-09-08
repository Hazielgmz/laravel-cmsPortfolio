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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->text('codeLink')->nullable(); // GitHub, demo, etc.
            $table->text('PreviewLink')->nullable(); // URL de vista previa
            $table->text('image')->nullable(); // URL de imagen
            $table->boolean('visible')->default(false); // Visibilidad
            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
