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
        Schema::create('activo_asignacions', function (Blueprint $table) {
            $table->increments('idasignacion'); 
            $table->integer('idactivo')->unsigned(); 
            $table->bigInteger('iduser')->unsigned();   
            $table->date('fechaini'); 
            $table->integer('estadoini')->comment('1-bueno, 2-regular, 3-malo');
            $table->string('obs',1000)->nullable();
            $table->string('codactivoasig',20)->nullable();
            $table->date('fechafin')->nullable();
            $table->integer('estadofin')->nullable()->comment('1-bueno, 2-regular, 3-malo'); 
            $table->string('obsfin',1000)->nullable();
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->foreign('idactivo')->references('idactivo')->on('activos');
            $table->foreign('iduser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activo_asignacions');
    }
};
