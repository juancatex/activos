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
        Schema::create('depres', function (Blueprint $table) {
            $table->bigIncrements('iddepre'); 
            $table->integer('idactivo')->unsigned(); 
            $table->bigInteger('idufvini')->unsigned();   
            $table->bigInteger('idufvfin')->unsigned();   
            $table->double('ufvini', 15, 5); 
            $table->double('ufvfin', 15, 5); 
            $table->integer('vidai')->comment('inicial'); 
            $table->integer('vidat')->comment('tomado'); 
            $table->integer('vidaf')->comment('final'); 
            $table->integer('gestion');
            $table->integer('periodo');
            $table->double('vc', 15, 2); 
            $table->double('va', 15, 2); 
            $table->double('ia', 15, 2); 
            $table->double('daan', 15, 2); 
            $table->double('ida', 15, 2); 
            $table->double('pd', 15, 2); 
            $table->double('acu', 15, 2); 
            $table->double('valor', 15, 2); 
            $table->foreign('idactivo')->references('idactivo')->on('activos');
            $table->foreign('idufvini')->references('idufv')->on('ufvs');
            $table->foreign('idufvfin')->references('idufv')->on('ufvs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depres');
    }
};
