@extends('layout')

@section('cabecalho')
    Adicionar aluno
@endsection


@section('conteudo')
    @include('erros', ['errors' => $errors])

    <a class="btn btn-dark ms-5 mt-3 mb-3" onclick="history.go(-1)" href="javascript:void(0)">Voltar</a>
    <div class="container mx-5 mt-4">
        
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-7">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome">
            </div>
            <div class="col-md-7 mt-2">
                <label for="ra">RA</label>
                <input type="number" class="form-control" name="ra" id="ra">
            </div>
            
            <button class="btn btn-dark mt-3">Adicionar</button>
        
        </form>
    </div>
@endsection