<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;
use App\Models\Assunto;
use App\Models\Portaria;
use App\Models\User;
use App\Models\Perfil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PortariaController extends Controller
{
    public function create() {
        $assuntos = Assunto::orderBy('nome', 'asc')->get();
        $user = Auth::user();
        $setor = Setor::find($user->setor_id);
        $nomeSetor = $setor->sigla.' - '.$setor->nome;

        return view('portarias.create',['assuntos' => $assuntos, 'nomeSetor' => $nomeSetor]);
    }

    public function index() {
        $setores = Setor::orderBy('sigla', 'asc')->get();
        $assuntos = Assunto::orderBy('nome', 'asc')->get();
        $portarias = Portaria::all();

        // if(Auth::user()->perfil_id < 3) {
        //     $portarias = Portaria::where('setor_id', '=', Auth::user()->setor_id)->get();
        // }

        $users = User::all();
        return view('portarias.index',['setores' => $setores, 'assuntos' => $assuntos, 'portarias' => $portarias, 'users' => $users]);
    }

    public function search() {
        // $setores = Setor::all();
        $setores = Setor::orderBy('sigla', 'asc')->get();
        // $assuntos = Assunto::all();
        $assuntos = Assunto::orderBy('nome', 'asc')->get();
        return view('portarias.search',['setores' => $setores, 'assuntos' => $assuntos]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $portaria = $request->all();

        $messages = [
            'data.required' => 'O campo data é obrigatório.',
            'assunto_id.required' => 'O campo assunto é obrigatório.'
        ];

        $data = $request-> validate([
            'data' => 'required',
            'assunto_id' => 'required',
        ], $messages);

        $portaria['usuario_id'] = $user->id;
        $portaria['setor_id'] = $user->setor_id;
        $data = $portaria['data'];

        // dd($data);

        $array_portaria = DB::table('portarias')
             ->select(DB::raw('numero, YEAR(data) as ano'))
             ->whereRaw("id = (SELECT MAX(id) from portarias where YEAR(data) = YEAR( \"$data\"))")
             ->get();

        // dd($array_portaria);

        if(!isset($array_portaria[0]->ano)) {
            $portaria['numero'] = 1;
        } else if($array_portaria[0]->ano < (int) date('Y', strtotime($portaria['data']))) {
            $portaria['numero'] = 1;
        } else {
            $portaria['numero'] = $array_portaria[0]->numero + 1;
        }

        // dd($portaria);

        $portaria = Portaria::create($portaria);
        $id_portaria = $portaria['id'];

        return redirect('/portaria/detail/' . $id_portaria);

    }

    public function detail($id_portaria) {
        $portaria = Portaria::find($id_portaria);

        $user = User::find($portaria['usuario_id']);

        $deleted_by = User::find($portaria->deleted_by);

        $updated_by = User::find($portaria->updated_by);

        // $updated_at = User::find($portaria->updated_at);

        $setor = Setor::find($portaria['setor_id']);

        $assunto = Assunto::find($portaria['assunto_id']);

        $nomeSetor = $setor->sigla.' - '.$setor->nome;

        $dataAtual = date_format(date_create_from_format('Y-m-d', $portaria['data']), 'd/m/Y');

        if(!empty($portaria['data_inicio'])) {
            $portaria['data_inicio'] = date_format(date_create_from_format('Y-m-d', $portaria['data_inicio']), 'd/m/Y');
        }

        if(!empty($portaria['data_final'])) {
            $portaria['data_final'] = date_format(date_create_from_format('Y-m-d', $portaria['data_final']), 'd/m/Y');
        }

        if(!empty($portaria['deleted_at'])) {
            $portaria['deleted_at'] = date_format(date_create_from_format('Y-m-d h:i:s', $portaria['deleted_at']), 'd/m/Y h:i:s');
        }

        // if($updated_at != null) {
        //     $updated_at = $updated_at->format('d/m/Y h:i:s');
        // }

        $novaPortaria = [
            'id' => $portaria['id'],
            'nome' => $user['name'],
            'user_id' => $user->id,
            'nomeSetor' => $nomeSetor,
            'processo' => $portaria['processo'],
            'data' => $dataAtual,
            'assunto' => $assunto['nome'],
            'data_inicio' => $portaria['data_inicio'],
            'data_final' => $portaria['data_final'],
            'observacoes' => $portaria['observacoes'],
            'destino' => $portaria['destino'],
            'numero' => $portaria['numero'],
            'deleted_at' => $portaria['deleted_at'],
            // 'updated_at' => $updated_at,
            'deleted_by' => $deleted_by,
            'updated_by' => $updated_by,
        ];

        return view('portarias.detail', $novaPortaria);

        // return view('portarias.detail',['portaria' => $portaria, 'nomeSetor' => $nomeSetor]);
    }

    public function edit($id_portaria){

        $portaria = Portaria::find($id_portaria);
        $setores = Setor::orderBy('sigla', 'asc')->get();
        $assuntos = Assunto::orderBy('nome', 'asc')->get();

        return view('portarias.edit',['portaria' => $portaria, 'setores' => $setores, 'assuntos' => $assuntos]);

    }

    public function update($id_portaria, Request $request) {

        $portaria = Portaria::find($id_portaria);

        $data = $request->validate([
            'usuario_id' => 'required|integer',
            'setor_id' => 'required|integer',
            'assunto_id' => 'required|integer',
            'data' => 'required',
        ]);

        $portaria->processo = $request['processo'];
        $portaria->assunto_id = $request['assunto_id'];
        $portaria->data = $request['data'];
        $portaria->data_inicio = $request['data_inicio'];
        $portaria->data_final = $request['data_final'];
        $portaria->observacoes = $request['observacoes'];
        $portaria->destino = $request['destino'];
        
        $portaria->updated_by = Auth::user()->id;

        $portaria->save();
        return redirect(route('portaria.index'))->with('success', 'portaria salva com sucesso');
    }

    public function softDelete($id_portaria){
        $portaria = Portaria::find($id_portaria);
        $currentDateTime = Carbon::now()->toDateTimeString();
        $portaria->deleted_at = $currentDateTime;
        $portaria->deleted_by = Auth::user()->id;
        $portaria->save();

        return redirect(route('portaria.index'))->with('success','Portaria deletada com sucesso!');
    }

    public function enable($id_portaria) {
        $portaria = Portaria::find($id_portaria);
        $portaria->deleted_at = null;
        $portaria->deleted_by = null;
        $portaria->save();

        return redirect(route('portaria.index'))->with('success','Portaria habilitada com sucesso!');
    }

}
