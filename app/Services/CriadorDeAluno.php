<?php

namespace App\Services;

use App\Models\Aluno;
use Illuminate\Support\Facades\DB;

class CriadorDeAluno
{
    public function criarAluno(string $nome, int $ra)
    {
        DB::beginTransaction();
        Aluno::create(['nome' => $nome, 'ra' => $ra]);
        DB::commit();   
        return $nome; 
    }
}

