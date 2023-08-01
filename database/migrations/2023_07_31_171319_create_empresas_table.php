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
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('idempresa');
            $table->string('nombre')->nullable();
            $table->string('direccion')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('nit')->default(0)->nullable();
            $table->integer('telefono1')->default(0)->nullable();
            $table->integer('telefono2')->default(0)->nullable();
            $table->integer('telefono3')->default(0)->nullable();
            $table->integer('telefono4')->default(0)->nullable();
            $table->string('ciudad')->nullable();
            $table->string('web')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
