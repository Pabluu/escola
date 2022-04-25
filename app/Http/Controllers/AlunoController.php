<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Support\Facades\DB;


class AlunoController extends Controller
{

    public function listaAlunos()
    {
        return DB::table("aluno AS al")
            ->join('curso AS cs', 'al.curso_id', '=', 'cs.id')
            ->select('al.*', 'cs.nome AS nome_curso')
            ->get();
    }

    public function index()
    {
        $aluno = new Aluno();
        $alunos = $this->listaAlunos();
        $cursos = Curso::All();
        return view("aluno.index", [
            "aluno" => $aluno,
            "alunos" => $alunos,
            "cursos" => $cursos
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if ($request->get('id') != '') {
            $aluno = Aluno::Find($request->get('id'));
        } else {
            $aluno = new Aluno();
        }

        $aluno->nome = $request->get('nome');
        $aluno->email = $request->get('email');
        $aluno->curso_id = $request->get('curso_id');

        if ($request->file("foto") != null) {
            $aluno->foto = $request->file("foto")->store("public/alunos");
        }

        $aluno->save();

        $request->session()->flash('status', 'salvo');
        return redirect('/aluno');
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aluno = Aluno::Find($id);
        $alunos = $this->listaAlunos();
        $cursos = Curso::All();

        return view('aluno.index', [
            'aluno' => $aluno,
            'alunos' => $alunos,
            'cursos' => $cursos
        ]);
    }


    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,  Request $request)
    {
        Aluno::Destroy($id);
        $request->session()->flash('status', 'excluido');
        return redirect('/aluno');
    }
}
