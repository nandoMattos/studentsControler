<?php
namespace App\Services;

use App\Models\Nota;
use Illuminate\Support\Facades\DB;

class RemovedorDeNota
{
    public function removerNota(int $notaId):string
    {
        $nomeDisicplinha = '';

        DB::transaction(function() use ($notaId, &$nomeDisicplinha) {
            $notas = Nota::find($notaId);
            $nomeDisicplinha = $notas->disciplina; 

            $notas->delete();
        });

        return $nomeDisicplinha;
    }
}
