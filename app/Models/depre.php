<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class depre extends Model
{
    use HasFactory;
    protected $fillable = ['idactivo','idufvini','ufvini','ufvfin','idufvfin','vidai','vidat','vidaf','gestion','periodo','vc','va','ia','daan','ida','pd','acu'];
    protected $primaryKey = 'iddepre';
           
}
