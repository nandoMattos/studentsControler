<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunosFormRequest;
use App\Models\Aluno;
use App\Models\Nota;
use App\Services\CriadorDeAluno;
use App\Services\RemovedorDeAluno;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlunosController extends Controller
{
    public function index(Request $request) {
        $alunos = Aluno::query()->get();
        $notas = Nota::query()->paginate(15);        
        $arrayNotas = [];
        $cont = 0;
        foreach ($alunos as $aluno) {
            $qtdeNotas = DB::table('notas')->where(['aluno_id' => $aluno->id])->count();
            array_push($arrayNotas, $qtdeNotas);
        }
        $mensagem = $request->session()->get('mensagem');
        return view('alunos.index', compact('alunos', 'arrayNotas', 'cont', 'mensagem'));
    }

    public function create(){
        return view('alunos.create');
    }

    public function store(AlunosFormRequest $request, CriadorDeAluno $criadorDeAluno) {
        
        if (strlen($request->ra) != 7){
            return redirect()->back()->withErrors('RA deve conter 7 dígitos');
        }

        try{
            $nomeAluno = $criadorDeAluno->criarAluno($request->nome, $request->ra);
        } catch(QueryException $error) {
            return redirect()->back()->withErrors(($error->getCode() == 23000) ? 'RA já cadastrado': '');
        }
        $request->session()->flash('mensagem', "Aluno(a) {$nomeAluno} criado(a) com  sucesso");
        return redirect('/alunos');
    }


    public function destroy(Request $request, RemovedorDeAluno $removedorDeAluno){
        $nomeAluno = $removedorDeAluno->removerAluno($request->id);
        $request->session()->flash('mensagem', "Aluno(a) {$nomeAluno} removido(a) com sucesso.");
        return redirect('/alunos');
    }

    public function editaNome(int $id, Request $request){
        $novoNome = $request->nome;
        $aluno = Aluno::find($id);
        $aluno->nome = $novoNome;
        $aluno->save();
    }
}