<?php

use App\Models\Profesional;
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
        Schema::create('profesionals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra_id')->constrained();
            $table->foreignId('medio_id')->constrained();
            $table->string('autor', 200);
            $table->string('contenido', 5000);

            $table->timestamp(Profesional::CREATED_AT)->useCurrent();
            $table->timestamp(Profesional::UPDATED_AT)->useCurrent();

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionals');
    }
};
