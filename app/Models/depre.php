<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class depre extends Model
{
    use HasFactory;
    protected $fillable = ['gestion','periodo','vc','va','ia','daan','ida','pd'];
    protected $primaryKey = 'iddepre';
           
}
