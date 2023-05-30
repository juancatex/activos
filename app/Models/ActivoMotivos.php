<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivoMotivos extends Model
{
    use HasFactory;
    protected $fillable = ['nommotivo'];
    protected $primaryKey = 'idmotivo'; 
}
