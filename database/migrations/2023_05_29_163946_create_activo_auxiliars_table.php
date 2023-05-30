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
        Schema::create('activo_auxiliars', function (Blueprint $table) {
            $table->increments('idauxiliar');
            $table->integer('idgrupo')->unsigned(); 
            $table->string('codauxiliar',2);
            $table->string('nomauxiliar',50);
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->foreign('idgrupo')->references('idag')->on('activo_grupos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activo_auxiliars');
    }
};
