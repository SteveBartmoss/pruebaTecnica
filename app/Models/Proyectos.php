<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    use HasFactory;
    protected $table = 'proyectos';
    protected $fillable = [
        'name',
        'description',
        'status',
    ];
}
