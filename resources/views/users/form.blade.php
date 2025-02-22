<x-app-layout>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow-lg p-4" style="width: 40%;">
            <h2 class="text-center mb-4">{{ isset($user) ? 'Editar Usuario' : 'Crear Usuario' }}</h2>
    
            <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
                @csrf
                @isset($user)
                    @method('PUT')
                @endisset
    
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
                </div>
    
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
                </div>
    
                @if(!isset($user))
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                @endif
    
                <div class="d-flex justify-content-between">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver</a>
                    <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>

</x-app-layout>
