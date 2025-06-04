<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    use HasFactory;
    protected $table = 'tarea';
    protected $fillable = [
        'project_id',
        'title',
        'completed',
        'due_date',
    ];
}
