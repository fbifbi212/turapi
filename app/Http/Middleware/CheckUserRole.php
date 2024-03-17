<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        $tour = $request->route('tour');

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Kullanıcının rolü, izin verilen roller listesinde değilse 403 hatası döndür
        if (!in_array($user->role, $roles)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Eğer kullanıcı tur operatorü ise ve sadece kendi turunu yönetiyorsa 403 hatası döndür
        if ($tour && $user->isTourOperator() && $user->id != $tour->user_id) {
            return response()->json(['error' => 'Unauthorized: You can only manage your own tours'], 403);
        }

        return $next($request);
    }
}
