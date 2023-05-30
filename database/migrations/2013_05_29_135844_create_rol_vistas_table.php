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
        Schema::create('rol_vistas', function (Blueprint $table) {
            $table->id();
            $table->integer('idrol')->unsigned(); 
            $table->integer('idg')->unsigned();  
            $table->integer('idm')->unsigned();  
            $table->integer('idv')->unsigned();  
            $table->timestamps();
            $table->foreign('idrol')->references('idrol')->on('rols');
            $table->foreign('idg')->references('idg')->on('grupos');
            $table->foreign('idm')->references('idm')->on('menus');
            $table->foreign('idv')->references('idv')->on('vistas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_vistas');
    }
};
