@extends('layout')

@section('cabecalho')
    Adicionar notas a {{ $aluno->nome }}
@endsection

@section('conteudo')
    @include('erros', ['errors' => $errors])

    <a class="btn btn-dark ms-5 mt-3 mb-3" onclick="history.go(-1)" href="javascript:void(0)">Voltar</a>
    <div class="container mx-5 mt-4 mb-4">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-7 mt-3">
                <label for="disciplina" class="form-label">Disciplina</label>
                <input type="text" class="form-control" name="disciplina" id="disciplina">
            </div>
            <div class="col-md-7 mt-3">
                <label for="nota1" class="form-label">Nota P1</label>
                <input type="number" min="0" max="10" class="form-control" name="nota1" id="nota1">
            </div> 
            <div class="col-md-7 mt-3">
                <label for="nota2" class="form-label">Nota P2</label>
                <input type="number" min="0" max="10" class="form-control" name="nota2" id="nota2">
            </div>
            <div class="col-md-7 mt-3">
                <label for="nota3" class="form-label">Nota P3</label>
                <input type="number" min="0" max="10" class="form-control" name="nota3" id="nota3">
            </div>
            <div class="col-md-7 mt-3">
                <label for="nota4" class="form-label">Nota P4</label>
                <input type="number" min="0" max="10" class="form-control" name="nota4" id="nota4">
            </div>
            <button class="btn btn-dark mt-3">Adicionar</button>'
        </form>
    </div>
@endsection