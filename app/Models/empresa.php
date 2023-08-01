<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empresa extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','direccion','nit','telefono1','telefono2','telefono3','telefono4','ciudad','web','email'];
    protected $primaryKey = 'idempresa'; 
}
