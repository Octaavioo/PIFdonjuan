<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('producto_id')
                ->constrained('productos')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('bodega_id')
                ->constrained('bodegas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->unsignedInteger('cantidad')->default(0);

            $table->timestamps();

            $table->unique(['producto_id', 'bodega_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
