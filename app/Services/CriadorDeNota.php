<?php

namespace App\Services;

use App\Models\Nota;
use Illuminate\Support\Facades\DB;

class CriadorDeNota
{
    public function criarNota(string $nomeDisciplina, int $p1, int $p2, int $p3, int $p4, int $alunoId)
    {
        DB::beginTransaction();
        Nota::create([
            'disciplina' => $nomeDisciplina,
            'nota1' => $p1,
            'nota2' => $p2,
            'nota3' => $p3,
            'nota4' => $p4,
            'media_final' => $this->calculaMedia($p1, $p2, $p3, $p4),
            'aluno_id' => $alunoId
        ]);
        DB::commit();
        return $nomeDisciplina;
    }

    public function calculaMedia(int $p1, int $p2, int $p3, int $p4)
    {
        $mediaFinal = ($p1 + $p2 + $p3 + $p4) / 4;
        return $mediaFinal;
    }
}

