<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Setor;
use App\Models\Perfil;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $setores = Setor::orderBy('sigla', 'asc')->get();
        $perfis = Perfil::all();

        return view('auth.register', 
            ['setores' => $setores],
            ['perfis' => $perfis],
        );
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'username' => ['required', 'string', 'lowercase', 'max:255', 'unique:'.User::class],
            'setor' => ['required', 'integer'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'perfil_id' => null,
            'setor_id' => $request->setor
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('portaria.index', absolute: false));
    }
}
