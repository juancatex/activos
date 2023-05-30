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
        Schema::create('activo_grupos', function (Blueprint $table) {
            $table->increments('idag');
            $table->string('codgrupo',2);
            $table->string('nomgrupo',50);
            $table->tinyInteger('vida')->nullable(); 
            $table->integer('idcuentadepre')->nullable(); 
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activo_grupos');
    }
};
