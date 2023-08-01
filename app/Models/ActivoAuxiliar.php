<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivoAuxiliar extends Model
{
    use HasFactory;
    protected $fillable = ['idgrupo','codauxiliar','nomauxiliar','activo'];
    protected $primaryKey = 'idauxiliar';
      
}
