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
       Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->text('name'); // Ej: Laravel, Astro, PostgreSQL
            $table->text('type')->nullable(); // frontend, backend, database y framework
            $table->text('icon')->nullable(); // URL de icono
            $table->boolean('visible')->default(false); // Visibilidad
            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
