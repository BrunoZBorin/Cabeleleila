<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fone extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'ddd',
        'numero',
        'tipo',
        'codigo' 
    ];
}
