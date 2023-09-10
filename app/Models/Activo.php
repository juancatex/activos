<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Activo extends Model
{
    use HasFactory;
    protected $fillable = ['codactivo','idambiente','idgrupo','idauxiliar','fechaingreso','costo','descripcion','marca','serie','imagen','residual','obs','fechabaja','nrordenbaja','idmotivobaja','obsbaja'];
    protected $primaryKey = 'idactivo';
     
    public function getdepres():HasOne 
    {
        return $this->hasOne(depre::class,"idactivo")->ofMany('gestion', 'max');
    }
}
