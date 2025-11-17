<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
        });

        Schema::table('productos', function (Blueprint $table) {
            if (Schema::hasTable('productos')) {
                $table->foreignId('marca_id')
                      ->nullable()
                      ->after('id')
                      ->constrained('marcas')
                      ->nullOnDelete();
            }
        });
    }

    public function down(): void {
        Schema::table('productos', function (Blueprint $table) {
            if (Schema::hasColumn('productos', 'marca_id')) {
                $table->dropConstrainedForeignId('marca_id');
            }
        });
        Schema::dropIfExists('marcas');
    }
};
