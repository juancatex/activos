<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ufv extends Model
{
    use HasFactory;
    protected $fillable = ['fecha','valor'];
    protected $primaryKey = 'idufv'; 
}
