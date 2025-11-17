<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('historial_estados', function (Blueprint $table) {
            $table->id();
            $table->string('entidad');           // 'pedido'
            $table->unsignedBigInteger('entidad_id');
            $table->unsignedSmallInteger('estado'); // 0..5,9
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nota')->nullable();
            $table->timestamps();

            $table->index(['entidad','entidad_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('historial_estados');
    }
};
