<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivoGrupo extends Model
{
    use HasFactory;
    protected $fillable = ['codgrupo','nomgrupo','vida','idcuentadepre'];
    protected $primaryKey = 'idag';
      
}
