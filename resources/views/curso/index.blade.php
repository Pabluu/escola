@extends('templates.main')

@section('titulo', 'Cadastro de Cursos')

@section('formulario')
<form action='/curso' method='POST' class='row'>
    <div class='form-group col-10'>
        <label for='name'>Nome</label>
        <input type='text' id='nome' name='nome' @class([ "form-control" , "is-invalid"=> ($errors->first("nome") != "")
        ])
        value="{{$curso->nome}}"
        />

        <div class="invalid-feedback">
            {{$errors->first('nome')}}
        </div>
    </div>

    <div class='form-group col-2'>
        @csrf
        <input type='hidden' id='id' name='id' value='{{ $curso->id}}' />
        <a href='/curso' class='btn btn-primary' style='margin-top: 23px;'>
            <i class='bi-plus-square bi'></i> Novo
        </a>
        <button submit='submit' class='btn btn-success' style='margin-top: 23px;'>
            <i class='bi bi-save'></i> Salvar
        </button>
    </div>
</form>
@endsection

@section('tabela')
<br />
<h1>Tabela de Cursos</h1>
<table class='table table-striped'>
    <colgroup>
        <col width='400'>
        <col width='100'>
        <col width='100'>
    </colgroup>

    <thead>
        <tr>
            <td>Nome</td>
            <td>Editar</td>
            <td>Excluir</td>
        </tr>
    </thead>

    <tbody>
        @foreach($cursos as $curso)
        <tr>
            <td>{{ $curso->nome}}</td>
            <td>
                <a href='/curso/{{$curso->id}}/edit' class='btn btn-warning'>
                    <i class="bi bi-pencil-square"></i>Editar
                </a>
            </td>
            <td>
                @if($curso->total_alunos > 0)
                    <button type="button" onclick="excluir(this);" class='btn btn-danger disabled' >
                        <i class="bi bi-trash"></i>Excluir
                    </button>

                @else
                <form action='/curso/{{$curso->id}}' method='POST'>
                    @csrf
                    <input type='hidden' name='_method' value='DELETE'>
                    <button type="button" onclick="excluir(this);" class='btn btn-danger'>
                        <i class="bi bi-trash"></i>Excluir
                    </button>
                </form>
                @endif
            </td>

        </tr>
        @endforeach
    </tbody>

</table>
@endsection

<script>
    function excluir(btn) {
        Swal.fire({
            title: "Deseja realmente excluir?",
            "icon": "warning",
            "showCancelButton": true,
            "cancelButtonText": "Cancelar",
            "confirmButtonText": "Confirmar",
            "confirmButtonColor": "#17882c",
            "cancelButtonColor": "#d33"
        }).then(function(result) {
            if (result.isConfirmed) {
                $(btn).parents("form").submit();
            }
        });
    }
</script>