<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    /** @use HasFactory<\Database\Factories\PartidoFactory> */
    use HasFactory;
    /** tabla */
    public $table = 'partido';
    /** declaracion incial */
    public $filliable = [
        'id',
        'nombre',
        'siglas',
        'logo',
    ];
}
