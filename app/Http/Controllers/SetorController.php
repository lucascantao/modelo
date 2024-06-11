<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;
use App\Models\User;
use App\Models\Portaria;

class SetorController extends Controller
{
    public function index() {
        $setores = Setor::orderBy('sigla', 'asc')->get();
        return view('setores.index',['setores' => $setores]);
    }

    public function create() {
        return view('setores.create');
    }

    public function edit(Setor $setor) {
        return view('setores.edit',['setor' => $setor]);
    }

    public function store(Request $request) {
        //Mensagens de validação
        $messages = [
            'sigla.unique' => 'A sigla já está em uso.',
            'nome.unique' => 'O nome já está em uso.',
        ];

        $data = $request-> validate([
            'nome' => 'required|string|unique:setores,nome',
            'sigla' => 'required|string|unique:setores,sigla',
        ], $messages);

        $data['nome'] = mb_strtoupper($data['nome'],"utf-8" );
        $data['sigla'] = mb_strtoupper($data['sigla'],"utf-8" );

        $novoSetor = Setor::create($data);

        return redirect(route('setor.index'));
    }

    public function update(Setor $setor, Request $request) {
        $data = $request-> validate([
            'nome' => 'required|string',
            'sigla' => 'required|string',
        ]);

        $data['nome'] = mb_strtoupper($data['nome'],"utf-8" );
        $data['sigla'] = mb_strtoupper($data['sigla'],"utf-8" );

        $setor->update($data);

        return redirect(route('setor.index'))->with('success','Setor editado com sucesso!');
    }

    public function destroy($id) {

        if(User::where('setor_id', '=', $id)->get()->isNotEmpty()){
            return redirect(route('setor.index'))->with('failed', 'Não é possível excluir o setor, pois contém usuários registrados');    
        }

        if(Portaria::where('setor_id', '=', $id)->get()->isNotEmpty()){
            return redirect(route('setor.index'))->with('failed', 'Não é possível excluir o setor, pois existem portarias que o usam');    
        }

        $setor = Setor::find($id);
        $setor->delete();
        return redirect(route('setor.index'))->with('success', 'Setor excluído  com sucesso!');
    }
    
}