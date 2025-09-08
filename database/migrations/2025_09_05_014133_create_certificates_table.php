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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('issuer'); // Organización que lo dio
            $table->text('type')->nullable(); 
            $table->date('date')->nullable();
            $table->text('certificate_url')->nullable(); // URL al PDF o badge
            $table->boolean('visible')->default(false); // Visibilidad
            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
