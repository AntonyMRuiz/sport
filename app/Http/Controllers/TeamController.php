<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.form');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:teams']);
        Team::create($request->all());

        return redirect()->route('teams.index')->with('success', 'Equipo creado correctamente.');
    }

    public function show(Team $team)
    {
        return view('teams.show', compact('team'));
    }
}
