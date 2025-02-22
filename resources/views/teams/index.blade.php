<x-app-layout>

    <div class="container">
        <h2 class="text-center mb-4">Equipos</h2>
        <a href="{{ route('teams.create') }}" class="btn btn-primary mb-3">Nuevo Equipo</a>

        <ul class="list-group">
            @foreach ($teams as $team)
                <li class="list-group-item d-flex justify-content-between">
                    {{ $team->name }}
                    <a href="{{ route('teams.show', $team) }}" class="btn btn-secondary btn-sm">Ver</a>
                </li>
            @endforeach
        </ul>
    </div>

</x-app-layout>
