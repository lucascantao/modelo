<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Portaria;

class PortariaProtectedAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // dd($request->route());
        $portariaRoutePortariaId = $request->route()->parameters()['id'];
        $portariaRouteUserId = Portaria::find($portariaRoutePortariaId)->usuario_id;
        $portariaRouteSetorId = Portaria::find($portariaRoutePortariaId)->setor_id;


        if(
            (Auth::user()->id == $portariaRouteUserId)
            || (Auth::user()->perfil_id >= 2 && Auth::user()->setor_id == $portariaRouteSetorId)
            || Auth::user()->perfil_id >= 3
            )
        {
            return $next($request);
        }

        return redirect(route('portaria.index', absolute: false))->with('failed', 'Você não é autorizado a acessar essa portaria');
    }
}
