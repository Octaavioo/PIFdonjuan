<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('responsables', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('rut', 20)->nullable()->unique();
            $table->string('rol', 30)->default('Usuario');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('responsables');
    }
};
