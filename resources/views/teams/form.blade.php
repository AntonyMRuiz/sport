<x-app-layout>
    <div class="container">
        <h2 class="text-center mb-4">Crear Equipo</h2>

        <form action="{{ route('teams.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre del equipo</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</x-app-layout>
