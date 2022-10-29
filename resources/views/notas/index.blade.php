@extends('layout')

@section('cabecalho')
Notas de  {{ $aluno->nome }}
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

<a class="btn btn-dark ms-5 me-5 mt-3 mb-3" href="/alunos">Voltar</a>

<a href="/alunos/{{ $aluno->id }}/adicionar-notas" class="btn btn-dark me-5 mt-3 float-end">
    <i class="fas fa-plus"></i>
</a>

<ul class="list-group mb-4">
    @foreach ($notas as $nota)

        <li class="list-group-item mx-5">      
            <form class="d-inline" method="post" action="/alunos/{{ $aluno->id }}/notas/{{ $nota->id }}/excluir"
                onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($nota->disciplina) }}?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger float-end">
                    <i class="far fa-trash-alt"></i>
                </button>
            </form>
            <div id="disciplina-aluno-{{ $aluno->id }}"><strong>{{ $nota->disciplina }}</strong></div>
            
            <div id="aluno-{{ $aluno->id }}-nota1-{{ $nota->nota1 }}">Nota P1: <strong>{{ $nota->nota1 }}</strong></div>
            <div id="aluno-{{ $aluno->id }}-nota2-{{ $nota->nota2 }}">Nota P2: <strong>{{ $nota->nota2 }}</strong></div>
            <div id="aluno-{{ $aluno->id }}-nota3-{{ $nota->nota3 }}">Nota P3: <strong>{{ $nota->nota3 }}</strong></div>
            <div id="aluno-{{ $aluno->id }}-nota4-{{ $nota->nota4 }}">Nota P4: <strong>{{ $nota->nota4 }}</strong></div>
            <div id="aluno-{{ $aluno->id }}-media_final">Média Final: <strong>{{ $nota->media_final }}</strong></div>
        </li>
    @endforeach
</span>
</ul>

@endsection