<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();

            $table->string('tipo', 20);

            $table->foreignId('producto_id')
                ->constrained('productos')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('bodega_origen_id')
                ->nullable()
                ->constrained('bodegas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('bodega_destino_id')
                ->nullable()
                ->constrained('bodegas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->unsignedInteger('cantidad');

            $table->foreignId('responsable_id')
                ->constrained('responsables')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->text('observaciones')->nullable();

            $table->timestamp('fecha')->useCurrent();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
