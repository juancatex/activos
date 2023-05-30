<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    use HasFactory;
    protected $fillable = ['codactivo','idambiente','idgrupo','idauxiliar','fechaingreso','costo','descripcion','marca','serie','imagen','residual','obs','fechabaja','nrordenbaja','idmotivobaja','obsbaja'];
    protected $primaryKey = 'idactivo';
     
}
