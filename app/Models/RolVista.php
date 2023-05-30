<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolVista extends Model
{
    use HasFactory;
    protected $fillable = ['idrol','idg','idm','idu'];  
}
