<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Services\CriadorDeNota;
use App\Services\RemovedorDeNota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TypeError;

class NotasController extends Controller
{
    public function index(int $alunoId, Request $request)
    {
        $aluno = Aluno::find($alunoId);
        $notas = DB::table('notas')->where(['aluno_id' => $alunoId])->get();
        $mensagem = $request->session()->get('mensagem');
        return view('notas.index', compact('aluno', 'notas', 'mensagem')
        );
    }
    public function create(int $id){
        $aluno = Aluno::find($id);
        return view('notas.create', compact('aluno'));
    }
    
    public function store(int $id, Request $request, CriadorDeNota $criadorDeNota)
    {
        if (is_null($request->disciplina)){
            return redirect()->back()->withErrors('Insira uma Disciplina');
        }

        if(is_null($request->nota1) || is_null($request->nota2) || is_null($request->nota3) || is_null($request->nota4)){
            return redirect()->back()->withErrors('Notas não podem ser vazias');
        }
        $nomeDisciplina =$criadorDeNota->
        criarNota
        ($request->disciplina, 
            $request->nota1, 
            $request->nota2, 
            $request->nota3,
            $request->nota4,
            $id
        );
        $request->session()->flash('mensagem', "Disciplina {$nomeDisciplina} adicionada com sucesso.");
        return redirect()->route('notas', ['id' => $id]);
    }


    public function destroy(Request $request, RemovedorDeNota $removedorDeNota)
    {
        $nomeDisciplina = $removedorDeNota->removerNota($request->notaId);
        $request->session()->flash('mensagem', "Disciplina {$nomeDisciplina} removida com sucesso.");
        return back();
    }
}