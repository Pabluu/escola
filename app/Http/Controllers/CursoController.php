<?php

namespace App\Http\Controllers;
use App\Models\Curso;

use Illuminate\Http\Request;

class CursoController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $curso = new Curso();
        $cursos = Curso::All();

        return view('curso.index',[
            'curso' => $curso,
            'cursos' => $cursos
        ]);
    }


    public function store(Request $request){

        $request->validate([
            "nome" => "required|max:10"
        ], [
            "nome.required" => "Insira o nome do curso",
            "nome.max" => "O campo nome aceita no máximo :max caracteres"
        ]);

        if($request->get('id') != ''){
            $curso = Curso::Find($request->get('id'));
        }else{
            $curso = new Curso();
        }

        $curso->nome = $request->get('nome');
        $curso->save();
        $request->session()->flash('status', 'salvo');
        return redirect('/curso');
    }


    public function edit($id){
        $curso = Curso::Find($id);
        $cursos = Curso::All();
        
        return view('curso.index', [
            'curso' => $curso,
            'cursos' => $cursos
        ]);
    }


    public function destroy($id, Request $request){
        Curso::Destroy($id);
        $request->session()->flash('status', 'excluido');
        return redirect('/curso');
    }
}
