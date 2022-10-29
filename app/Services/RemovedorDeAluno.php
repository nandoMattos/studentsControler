<?php
namespace App\Services;

use App\Models\Aluno;
use App\Models\Nota;
use Illuminate\Support\Facades\DB;

class RemovedorDeAluno
{
    public function removerAluno(int $alunoId):string
    {
        $nomeAluno = '';
        DB::transaction(function() use ($alunoId, &$nomeAluno) {
            $aluno = Aluno::find($alunoId);
            $nomeAluno = $aluno->nome;

            $this->removerNotas($aluno);
            $aluno->delete();
        });

        return $nomeAluno;
    }

    private function removerNotas(Aluno $aluno): void
    {   
        $notas = DB::table('notas')->where(['aluno_id' => $aluno->id]);
        $notas->delete();
    }
}
