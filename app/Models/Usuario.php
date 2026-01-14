<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $table = 'usuarios';

    public $fillable = [
        'id',
        'nombre',
        'email',
        'password',
        'trabajo',
    ];
    public $timestamps = false;
} 
