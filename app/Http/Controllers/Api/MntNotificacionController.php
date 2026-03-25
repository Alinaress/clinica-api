<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MntNotificacion;
use Illuminate\Http\Request;

class MntNotificacionController extends Controller
{
    public function index(Request $request)
    {
        $notificaciones = MntNotificacion::with('cita')
            ->where('id_usuario', request()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['data' => $notificaciones]);
    }

    public function show($id)
    {
        $notificacion = MntNotificacion::with('cita')->findOrFail($id);
        return response()->json(['data' => $notificacion]);
    }

    // Marcar como leída
    public function update(Request $request, $id)
    {
        $notificacion = MntNotificacion::findOrFail($id);
        $notificacion->update(['leida' => true]);

        return response()->json(['message' => 'Notificación marcada como leída', 'data' => $notificacion]);
    }

    public function destroy($id)
    {
        $notificacion = MntNotificacion::findOrFail($id);
        $notificacion->delete();

        return response()->json(['message' => 'Notificación eliminada correctamente']);
    }

    // Marcar todas como leídas
    public function marcarTodasLeidas(Request $request)
{
    MntNotificacion::where('id_usuario', request()->user()->id)
        ->where('leida', false)
        ->update(['leida' => true]);

    return response()->json(['message' => 'Todas las notificaciones marcadas como leídas']);
}

    public function store(Request $request) {}
}
