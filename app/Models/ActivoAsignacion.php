<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivoAsignacion extends Model
{
    use HasFactory;
    protected $fillable = ['idactivo','iduser','fechaini','estadoini','obs','fechafin','estadofin'];
    protected $primaryKey = 'idasignacion';
  
               
}
