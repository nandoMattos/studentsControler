<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'quantidade_disciplinas',
        'disciplina',
        'nota1', 
        'nota2', 
        'nota3', 
        'nota4', 
        'media_final',
        'aluno_id'
    ];

    public function alunos()
    {
        return $this->belongsTo(Alunos::class);
    }
}
