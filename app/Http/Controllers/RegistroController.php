<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;
use App\Models\Registro;
use App\Models\User;
use App\Models\Perfil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RegistroController extends Controller
{
    public function create() {
        $user = Auth::user();
        $setor = Setor::find($user->setor_id);
        $nomeSetor = $setor->sigla.' - '.$setor->nome;

        return view('registros.create',['nomeSetor' => $nomeSetor]);
    }

    public function index() {
        $setores = Setor::orderBy('sigla', 'asc')->get();
        $registros = Registro::all();

        $users = User::all();
        return view('registros.index',['setores' => $setores, 'registros' => $registros, 'users' => $users]);
    }

    public function search() {
        // $setores = Setor::all();
        $setores = Setor::orderBy('sigla', 'asc')->get();
        // $assuntos = Assunto::all();
        return view('registros.search',['setores' => $setores]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $registro = $request->all();

        $messages = [
            'data.required' => 'O campo data é obrigatório.'
        ];

        $data = $request-> validate([
            'data' => 'required'
        ], $messages);

        $registro['usuario_id'] = $user->id;
        $data = $registro['data'];

        // dd($data);

        // dd($registro);

        $registro = Registro::create($registro);
        $id_registro = $registro['id'];

        return redirect('/registro/detail/' . $id_registro);

    }

    public function detail($id_registro) {
        $registro = Registro::find($id_registro);

        $user = User::find($registro['usuario_id']);

        $deleted_by = User::find($registro->deleted_by);

        $updated_by = User::find($registro->updated_by);

        $dataAtual = date_format(date_create_from_format('Y-m-d', $registro['data']), 'd/m/Y');

        if(!empty($registro['deleted_at'])) {
            $registro['deleted_at'] = date_format(date_create_from_format('Y-m-d h:i:s', $registro['deleted_at']), 'd/m/Y h:i:s');
        }

        $novaRegistro = [
            'id' => $registro['id'],
            'nome' => $user['name'],
            'user_id' => $user->id,
            'data' => $dataAtual,
            'deleted_at' => $registro['deleted_at'],
            // 'updated_at' => $updated_at,
            'deleted_by' => $deleted_by,
            'updated_by' => $updated_by,
        ];

        return view('registros.detail', $novaRegistro);

    }

    public function edit($id_registro){

        $registro = Registro::find($id_registro);

        return view('registros.edit',['registro' => $registro]);

    }

    public function update($id_registro, Request $request) {

        $registro = Registro::find($id_registro);

        $data = $request->validate([
            'usuario_id' => 'required|integer',
            'data' => 'required',
        ]);
        
        $registro->data = $request['data'];

        $registro->updated_by = Auth::user()->id;

        $registro->save();
        return redirect(route('registro.index'))->with('success', 'registro salva com sucesso');
    }

    public function softDelete($id_registro){
        $registro = Registro::find($id_registro);
        $currentDateTime = Carbon::now()->toDateTimeString();
        $registro->deleted_at = $currentDateTime;
        $registro->deleted_by = Auth::user()->id;
        $registro->save();

        return redirect(route('registro.index'))->with('success','Registro deletado com sucesso!');
    }

    public function enable($id_registro) {
        $registro = Registro::find($id_registro);
        $registro->deleted_at = null;
        $registro->deleted_by = null;
        $registro->save();

        return redirect(route('registro.index'))->with('success','Registro habilitado com sucesso!');
    }

}
