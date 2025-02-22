<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function updatePositions(Request $request)
    {
        // Se espera un JSON con "positions": [{ id, x, y }, ...]
        $positions = $request->input('positions');

        foreach ($positions as $pos) {
            $player = Player::find($pos['id']);
            if ($player) {
                $player->position_x = $pos['x'];
                $player->position_y = $pos['y'];
                $player->save();
            }
        }

        return response()->json(['success' => true, 'message' => 'Posiciones actualizadas']);
    }

    public function removeFromField($id)
    {
        $player = Player::findOrFail($id);
        $player->position_x = null;
        $player->position_y = null;
        $player->save();

        return response()->json(['success' => true, 'message' => 'Jugador removido']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'number'  => 'required|integer',
            'team_id' => 'required|exists:teams,id',
        ]);

        Player::create([
            'name'       => $request->name,
            'number'     => $request->number,
            'team_id'    => $request->team_id,
            'position_x' => null,
            'position_y' => null,
        ]);

        return redirect()->back()->with('success', 'Jugador agregado.');
    }

    public function update(Request $request, Player $player)
    {
        $request->validate([
            'position_x' => 'nullable|numeric',
            'position_y' => 'nullable|numeric',
        ]);

        $player->update([
            'position_x' => $request->position_x,
            'position_y' => $request->position_y,
        ]);

        return response()->json(['success' => true, 'message' => 'Posición actualizada', 'player' => $player]);
    }

    public function destroy(Player $player)
    {
        $player->delete();
        
        return response()->json(['success' => true, 'message' => 'Jugador eliminado.']);
    }
}
