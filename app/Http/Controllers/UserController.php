<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Perfil;
use App\Models\Setor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index() {
        $user = Auth::user();
        $setores = Setor::all()->sortBy('sigla');
        $perfis = Perfil::all()->sortBy('nome');

        if($user->perfil_id < 3){
            $users = User::where('setor_id', '=', $user->setor_id)->orWhere('perfil_id','=', 3)->OrderBy('name')->get();
        } else {
            $users = User::all()->sortBy('name');
        }
        // pr[i]nt_r($users);die();

        return view('users.index', [
            'users' => $users,
            'setores' => $setores,
            'perfis' => $perfis
        ]);
    }

    public function enable($id) {
        $user = User::find($id);
        $user->deleted_at = null;
        $user->save();
        return redirect(route('user.index'))->with('success','Usuário habilitado com sucesso!');

    }

    public function edit($id) {
        $user = User::find($id);
        $setores = Setor::orderBy('sigla', 'asc')->get();
        $perfis = Perfil::where('id', '<=', Auth::user()->perfil_id)->get();
        return view('users.edit', [
            'user' => $user,
            'setores' => $setores,
            'perfis' => $perfis,
        ]);
    }

    public function update($id, Request $request) {
        $user = User::find($id);
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'setor_id' => 'required',
            'perfil_id' => 'required',
        ]);



        $user->update($data);

        return redirect(route('user.index'))->with('success','Usuário editado com sucesso!');
    }

    public function disable($id, Request $request) {
        $user = User::find($id);
        $currentDateTime = Carbon::now()->toDateTimeString();
        $user->deleted_at = $currentDateTime;
        $user->save();

        if($user->id == Auth::user()->id) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect(route('login'))->with('failed','Seu usuário foi desabilitado');
        }else {
            return redirect(route('user.index'))->with('failed','Usuário desabilitado com sucesso!');
        }

    }
}
