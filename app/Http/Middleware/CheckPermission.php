<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        $user = Auth::user();

        // Capturar la URL actual
        $currentUrl = $request->fullUrl();

        // Capturar el nombre de la ruta actual
        $routeName = $request->route()->getName() ?? 'Ruta sin nombre';

        // Registrar información para debugging (opcional)
        Log::info('Verificando permiso', [
            'url' => $currentUrl,
            'route_name' => $routeName,
            'permissions_required' => $permissions
        ]);

        // Verificar si el usuario está autenticado y si tiene alguno de los permisos requeridos
        if ($user && $user->role && $user->role->permissions->pluck('id')->intersect(explode(',', $permissions[0]))->isNotEmpty()) {
            // Puedes agregar un log de acceso permitido si lo deseas
            Log::info('Acceso permitido', [
                'user_id' => $user->id,
                'url' => $currentUrl
            ]);

            return $next($request); // Permitir acceso si tiene al menos uno de los permisos
        }
    
        // Log de acceso denegado
        Log::warning('Acceso denegado', [
            'user_id' => $user ? $user->id : 'No autenticado',
            'url' => $currentUrl,
            'route_name' => $routeName
        ]);

        $Info = [
            'intentedUrl' => $currentUrl,
            'routeName' => $routeName,
            'title' => 'Estás intentando acceder a una zona a la que no tienes permiso'
        ];

        session()->put('access_denied_info', $Info);
        // Redirigir o mostrar un mensaje si no tiene permiso
        return redirect('/zona-no-autorisada');
    }
}

