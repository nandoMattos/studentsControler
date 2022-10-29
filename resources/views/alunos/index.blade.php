@extends('layout')

@section('cabecalho')
    Alunos
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

<a class="mx-5 mt-3 mb-3 btn btn-dark" href="/alunos/criar">Adicionar Alunos</a>

<ul class="list-group mb-4">
    @foreach ($alunos as $aluno)
            <li class="list-group-item mx-5">

                <span class="row align-items-center">
                    <span class="col" id="nome-aluno-{{ $aluno->id }}">{{ $aluno->nome }}</span>

                    <div class="input-group w-50 col" hidden id="input-nome-aluno-{{ $aluno->id }}">
                        <input type="text" class="form-control" value="{{ $aluno->nome }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" onclick="editarAluno({{ $aluno->id }})">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                    </div>

                    <span class="col pe-2">
                        <button class="btn btn-info btn-sm" onclick="toggleInput({{ $aluno->id }})">
                            <i class="fas fa-edit"></i>
                        </button>
                    </span>

                    <div class="col">
                        <strong>Disciplinas:</strong> {{$arrayNotas[$cont]}}
                    </div>

                    <div class="d-none">
                        {{ $cont++ }}
                    </div>

                    <span class="col-2 d-flex">
                        <a href="/alunos/{{ $aluno->id }}/notas/" class="ms-2 btn btn-info btn-sm me-1">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <a href="/alunos/{{ $aluno->id }}/adicionar-notas" class="btn btn-info btn-sm mr1">
                            <i class="fas fa-plus"></i>
                        </a>
                    </span>
                    <form method="post" action="/alunos/{{ $aluno->id }}" class="col-1"
                        onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($aluno->nome) }}?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger ms-5 float-end">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
        
                </span>
            </li>
    @endforeach
</ul>

<script>    
    function toggleInput(alunoId) {
        const nomeAluno1 = document.getElementById(`nome-aluno-${alunoId}`);
        const inputAluno1 = document.getElementById(`input-nome-aluno-${alunoId}`);
        if(nomeAluno1.hasAttribute('hidden')){
            nomeAluno1.removeAttribute('hidden');
            inputAluno1.hidden = true;
        } else{
            inputAluno1.removeAttribute('hidden');
            nomeAluno1.hidden = true;
        }
    }
 
    function editarAluno(alunoId) {
        let formData = new FormData();
        const nome = document.querySelector(`#input-nome-aluno-${alunoId} > input`).value;
        const token = document.querySelector(`input[name="_token"]`).value;
        formData.append('nome', nome);
        formData.append('_token', token);
        const url = `/alunos/${alunoId}/editaNome`;
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
            toggleInput(alunoId);
            document.getElementById(`nome-aluno-${alunoId}`).textContent = nome;
        });
    }
</script>

@endsection 