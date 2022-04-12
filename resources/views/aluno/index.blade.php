@extends("templates.main")
@section("titulo", "Cadastro de Alunos")

@section("formulario")
    <h1>Cadastro de Alunos</h1>
    <form method="POST" action="/aluno" class="row">
        <div class='form-group col-6'>
            <label for="nome">Nome</label>
            <input type="text" id='nome' name='nome' class='form-control' value='{{$aluno->nome}}' required />
        </div>
        <div class='form-group col-6'>
            <label for="email">Email</label>
            <input type="email" id='email' name='email' class='form-control' value='{{$aluno->email}}' required />
        </div>

        <div class='form-group col-6'>
            <label for="curso_id">Curso</label>
            <select for="curso_id" name='curso_id' class='form-control' required>
                <option value="">---</option>
                    @foreach ($cursos as $curso)
                        <option value="{{$curso->id}}">
                            {{$curso->nome}}
                        </option>
                    @endforeach
            </select>
        </div>

        <div class='form-group col-4'>
            <label for="foto">Foto</label>
            <input type="file" id='foto' name='foto' class='form-control' />
        </div>

        <div class='form-group col-2'>
            @csrf
            <input type='hidden' id='id' name='id' value='{{ $aluno->id}}' />
            <a href='/aluno' class='btn btn-primary' style='margin-top: 23px;'>
                <i class='bi-plus-square bi'></i> Novo
            </a>

            <button submit='submit' class='btn btn-success' style='margin-top: 23px;'>
                <i class='bi bi-save'></i> Salvar
            </button>

        </div>
    </form>
@endsection

@section("tabela")
    <br />
    <h1>Tabela de Alunos</h1>
    <table class='table table-striped'>
        <colgroup>
            <col width='300'>
            <col width='300'>
            <col width='300'>
            <col width=100>
            <col width=100>
        </colgroup>

        <thead>
            <tr>
                <th>Nome</th>
                <th>Curso</th>
                <th>Foto</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>

        <tbody>
            @foreach($alunos as $aluno)
            <tr>
                <td>{{$aluno->nome}}</td>
                <td>{{$aluno->curso_id}}</td>
                <td></td>
                <td>
                    <a href='/aluno/{{$aluno->id}}/edit' class='btn btn-warning'>
                    <i class="bi bi-pencil-square"></i>Editar
                    </a>
                </td>

            <td>
                <form action='/aluno/{{$aluno->id}}' method='POST'>
                    @csrf
                    <input type='hidden' name='_method' value='DELETE'>
                    <button type="button" onclick="excluir(this);" class='btn btn-danger'>
                        <i class="bi bi-trash"></i>Excluir
                    </button>
                </form></td>
                <td></td>
            </tr>
            @endforeach
        </tbody>

    </table>

@endsection