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
        Schema::create('activos', function (Blueprint $table) {
            $table->increments('idactivo');
            $table->string('codactivo',20); 
            $table->integer('idambiente')->unsigned(); 
            $table->integer('idgrupo')->unsigned(); 
            $table->integer('idauxiliar')->unsigned(); 
            $table->date('fechaingreso');
            $table->float('costo'); 
            $table->string('descripcion',150)->nullable();
            $table->string('marca',20)->nullable();
            $table->string('serie',20)->nullable();
            $table->string('imagen')->nullable();
            $table->float('residual')->default(0)->nullable();
            $table->string('obs',100)->nullable(); 
            $table->date('fechabaja')->nullable();
            $table->string('nrordenbaja',10)->nullable();
            $table->tinyInteger('idmotivobaja')->nullable();
            $table->string('obsbaja',100)->nullable();
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->foreign('idambiente')->references('idambiente')->on('ambientes');
            $table->foreign('idgrupo')->references('idag')->on('activo_grupos');
            $table->foreign('idauxiliar')->references('idauxiliar')->on('activo_auxiliars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activos');
    }
};
