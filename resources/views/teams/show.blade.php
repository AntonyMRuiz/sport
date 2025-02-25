<x-app-layout>
    <div class="container">
        <!-- Nombre del Equipo Centrado, Grande y en Negrita -->
        <h1 class="text-center fw-bold" style="font-size: 2rem; margin-bottom: 20px;">
            {{ $team->name }}
        </h1>

        <div class="row">
            <!-- Jugadores Disponibles -->
            <div class="col-md-3">

                <!-- Form para agregar jugadores -->
                <form method="POST" action="{{ route('players.store') }}" class="mb-3">
                    @csrf
                    <input type="hidden" name="team_id" value="{{ $team->id }}">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Nombre del jugador"
                        required>
                    <input type="text" name="number" class="form-control mb-2" placeholder="Número del jugador"
                        required>
                    <button type="submit" class="btn btn-primary">Agregar Jugador</button>
                </form>

                <!-- Lista de jugadores sin posición (disponibles) -->
                <ul class="list-group" id="player-list">
                    <h4 class="text-center w-100"> <strong>Jugadores disponibles</strong></h4>
                    @foreach ($team->players as $player)
                        @if (is_null($player->position_x) || is_null($player->position_y))
                            <li class="list-group-item player" draggable="true" data-id="{{ $player->id }}"
                                data-name="{{ $player->name }}" data-number="{{ $player->number }}">

                                <strong>{{ $player->number }}</strong> - {{ $player->name }}

                                <!-- Icono para eliminar jugador de la lista -->

                                <svg id="trash" data-id="{{ $player->id }}" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                    <path d="M10 11v6"></path>
                                    <path d="M14 11v6"></path>
                                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                                </svg>

                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <!-- Cancha y Papelera -->
            <div class="col-md-9 d-flex flex-column align-items-center">
                <h4 class="text-center w-100">Alineación</h4>


                <!-- <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    {{-- @foreach ($alineacion->alineaciones as $alineacion)
                        @if ($alineacion->team_id == $team->id)
                            <option value="{{ $alineacion->formation }}">{{ $alineacion->formation }}</option>
                        @elseif ($alineacion->default == 1)
                            <option selected value="{{ $alineacion->formation }}">{{ $alineacion->formation }}
                            </option>
                        @endif
                    @endforeach --}}
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select> -->

                <div id="field" class="football-box">
                    @foreach ($team->players as $player)
                        @if (!is_null($player->position_x) && !is_null($player->position_y))
                            <div class="player-icon" data-id="{{ $player->id }}"
                                data-player-number="{{ $player->number }}" data-player-name="{{ $player->name }}"
                                style="left: {{ $player->position_x }}px; top: {{ $player->position_y }}px;">

                                <!-- Estructura de "cabeza y cuerpo" -->
                                <div class="player-figure">
                                    <div class="player-head"></div>
                                    <div class="player-body">
                                        <span class="player-number">{{ $player->number }}</span>
                                    </div>
                                </div>
                                <!-- Nombre del jugador debajo -->
                                <div class="player-name">
                                    {{ $player->name }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Papelera: Zona de eliminación de jugadores -->
                {{-- <div id="trash" class="trash-bin">
                    <img src="https://img.icons8.com/fluency/48/000000/trash.png" alt="Papelera" />
                    <div class="trash-label">Papelera</div>
                </div> --}}

                <!-- Botón para guardar posiciones en lote -->
                {{-- <button id="save-positions" class="btn btn-success mt-3">
                    Guardar Posiciones
                </button> --}}
            </div>
        </div>
    </div>

    <!-- Estilos -->
    <style>
        .football-box {
            width: 500px;
            height: 800px;
            background: url('https://i.pinimg.com/550x/02/f0/a0/02f0a04d141f9159906da402d942ec83.jpg') no-repeat center center;
            background-size: cover;
            border-radius: 20px;
            border: 5px solid white;
            /* Borde blanco */
            position: relative;
            overflow: hidden;
        }

        .player {
            cursor: move;
            display: flex
        }

        .player svg {
            position: absolute;
            cursor: pointer;
            right: 0;
        }

        /* Contenedor principal de cada jugador en la cancha */
        .player-icon {
            position: absolute;
            cursor: move;
            /* Indicador de movimiento */
            user-select: none;
            /* Evita la selección de texto al arrastrar */
            text-align: center;
        }

        /* Estructura para la silueta (cabeza y cuerpo) */
        .player-figure {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* .player-head {
            width: 40px;
            height: 40px;
            background-color: #000;
            border-radius: 50%;
            margin-bottom: 5px;
        } */

        .player-body {
            width: 50px;
            height: 50px;
            background-color: #171ace;
            /* Negro */
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .player-number {
            color: #fff;
            /* Blanco */
            font-size: 24px;
            font-weight: bold;
        }

        .player-name {
            margin-top: 5px;
            font-weight: bold;
            color: #fff;
            /* Texto oscuro */
        }

        /* Estilos para la papelera */
        /* .trash-bin {
            width: 24px;
            height: 24px;
        } */

        /* .trash-label {
            font-size: 0.8rem;
            color: #555;
            margin-top: 5px;
        } */
    </style>

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let field = document.getElementById("field");
            let trash = document.getElementById("trash");

            // Función para limitar el movimiento al área de la cancha
            function makeDraggable(el) {
                el.addEventListener("mousedown", function(e) {
                    e.preventDefault();
                    let fieldRect = field.getBoundingClientRect();
                    let elRect = el.getBoundingClientRect();

                    // Diferencia entre la posición del cursor y la esquina del elemento
                    let shiftX = e.clientX - elRect.left;
                    let shiftY = e.clientY - elRect.top;

                    function onMouseMove(e) {
                        let newX = e.clientX - fieldRect.left - shiftX;
                        let newY = e.clientY - fieldRect.top - shiftY;

                        // Limitar para que el elemento no se salga del contenedor
                        newX = Math.max(0, Math.min(newX, fieldRect.width - elRect.width));
                        newY = Math.max(0, Math.min(newY, fieldRect.height - elRect.height));

                        el.style.left = newX + "px";
                        el.style.top = newY + "px";
                    }

                    function onMouseUp() {
                        document.removeEventListener("mousemove", onMouseMove);
                        document.removeEventListener("mouseup", onMouseUp);
                        savePositions();
                    }

                    document.addEventListener("mousemove", onMouseMove);
                    document.addEventListener("mouseup", onMouseUp);
                });
            }

            function deletePlayer(playerId) {
                fetch(`/players/${playerId}`, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error HTTP: " + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            console.log("Jugador eliminado.");
                        } else {
                            alert("Error al eliminar jugador.");
                        }
                        // Remover el icono de la cancha si existe
                        let icon = document.querySelector(`.player-icon[data-id="${playerId}"]`);
                        if (icon) {
                            icon.remove();
                        }
                        // Remover el jugador de la lista si existe
                        let listItem = document.querySelector(`.player[data-id="${playerId}"]`);
                        if (listItem) {
                            listItem.remove();
                        }
                    })
                    .catch(error => {
                        console.error("Error al eliminar jugador:", error);
                        alert("Error al eliminar jugador.");
                    });
            }
            // DRAG NATIVO para mover de la lista a la cancha
            document.querySelectorAll(".player").forEach(el => {
                el.addEventListener("dragstart", function(e) {
                    e.dataTransfer.setData("player-id", el.dataset.id);
                    e.dataTransfer.setData("number", el.dataset.number);
                    e.dataTransfer.setData("name", el.dataset.name);
                });
            });

            function savePositions(del) {
                let positions = [];
                field.querySelectorAll(".player-icon").forEach(icon => {
                    let id = icon.dataset.id;
                    let left = parseInt(icon.style.left);
                    let top = parseInt(icon.style.top);
                    positions.push({
                        id: id,
                        x: left,
                        y: top
                    });
                });

                if (del) positions.push({
                    id: del,
                    x: null,
                    y: null
                });

                fetch(`/api/players/positions`, {
                        method: "PATCH",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            positions: positions
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error HTTP: " + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            console.log("Posiciones guardadas correctamente.");
                        } else {
                            alert("Error al guardar posiciones.");
                        }
                    })
                    .catch(error => {
                        console.error("Error al guardar posiciones:", error);
                        alert("Error al guardar posiciones. Revisa la consola.");
                    });
            }

            // Permitir drop en la cancha
            field.addEventListener("dragover", function(e) {
                e.preventDefault();
            });

            // Al soltar un jugador en la cancha
            field.addEventListener("drop", function(e) {
                e.preventDefault();
                let rect = field.getBoundingClientRect();
                let x = e.clientX - rect.left;
                let y = e.clientY - rect.top;

                let playerId = e.dataTransfer.getData("player-id");
                let playerNumber = e.dataTransfer.getData("number");
                let playerName = e.dataTransfer.getData("name");

                // Remueve el jugador de la lista si existe
                let listItem = document.querySelector(`.player[data-id="${playerId}"]`);
                if (listItem) {
                    listItem.remove();
                }

                // Crea el ícono en la cancha
                let newIcon = document.createElement("div");
                newIcon.classList.add("player-icon");
                newIcon.setAttribute("data-id", playerId);
                // Guardar número y nombre en el dataset
                newIcon.dataset.playerNumber = playerNumber;
                newIcon.dataset.playerName = playerName;
                newIcon.style.left = x + "px";
                newIcon.style.top = y + "px";

                // Estructura cabeza-cuerpo
                let figure = document.createElement("div");
                figure.classList.add("player-figure");

                let head = document.createElement("div");
                head.classList.add("player-head");

                let body = document.createElement("div");
                body.classList.add("player-body");
                body.innerHTML = `<span class="player-number">${playerNumber}</span>`;

                figure.appendChild(head);
                figure.appendChild(body);
                newIcon.appendChild(figure);

                // Nombre debajo
                let nameDiv = document.createElement("div");
                nameDiv.classList.add("player-name");
                nameDiv.textContent = playerName;
                newIcon.appendChild(nameDiv);

                // Hacer arrastrable dentro de la cancha con límites
                makeDraggable(newIcon);

                // Doble clic: devolver el jugador a la lista
                newIcon.addEventListener("dblclick", function() {
                    let pId = newIcon.dataset.id;
                    let pNumber = newIcon.dataset.playerNumber;
                    let pName = newIcon.dataset.playerName;

                    // Crear <li> para devolverlo a la lista
                    let li = document.createElement('li');
                    li.classList.add('list-group-item', 'player');
                    li.setAttribute('draggable', 'true');
                    li.dataset.id = pId;
                    li.dataset.number = pNumber;
                    li.dataset.name = pName;
                    li.innerHTML = `<strong>#${pNumber}</strong> - ${pName}`;

                    // Evento dragstart para el nuevo <li>
                    li.addEventListener("dragstart", function(e) {
                        e.dataTransfer.setData("player-id", li.dataset.id);
                        e.dataTransfer.setData("number", li.dataset.number);
                        e.dataTransfer.setData("name", li.dataset.name);
                    });

                    document.getElementById('player-list').appendChild(li);
                    newIcon.remove();
                });

                field.appendChild(newIcon);
                savePositions();
            });

            // Hacer arrastrables los jugadores que ya están en la cancha
            document.querySelectorAll(".player-icon").forEach(el => {
                makeDraggable(el);
                // Doble clic para devolver a la lista
                el.addEventListener("dblclick", function() {
                    let pId = el.dataset.id;
                    let pNumber = el.dataset.playerNumber;
                    let pName = el.dataset.playerName;

                    let li = document.createElement('li');
                    li.classList.add('list-group-item', 'player');
                    li.setAttribute('draggable', 'true');
                    li.dataset.id = pId;
                    li.dataset.number = pNumber;
                    li.dataset.name = pName;
                    li.innerHTML = `<strong>${pNumber}</strong> - ${pName}

                                <svg id="trash" data-id="${pId}" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                    <path d="M10 11v6"></path>
                                    <path d="M14 11v6"></path>
                                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                                </svg>`;

                    li.addEventListener("dragstart", function(e) {
                        e.dataTransfer.setData("player-id", li.dataset.id);
                        e.dataTransfer.setData("number", li.dataset.number);
                        e.dataTransfer.setData("name", li.dataset.name);
                    });

                    document.getElementById('player-list').appendChild(li);
                    el.remove();
                    savePositions(pId);
                    console.log("Jugador devuelto a la lista");
                });
            });

            document.querySelectorAll('#trash').forEach(el => el.addEventListener("click", function(e) {
                e.preventDefault();
                let playerId = e.target.parentNode.getAttribute("data-id");
                console.log("Eliminar jugador, ID:", playerId);
                deletePlayer(playerId);
            }));

            // Configurar la papelera como zona de drop para eliminar jugadores
            trash.addEventListener("dragover", function(e) {
                e.preventDefault();
            });

            trash.addEventListener("click", function(e) {
                e.preventDefault();
                let playerId = e.target.parentNode.getAttribute("data-id");
                // let playerId = e.dataTransfer.getData("player-id");
                console.log("Eliminar jugador, ID:", playerId);

                // Petición DELETE al servidor (asegúrate de tener la ruta definida en web.php) 
                deletePlayer(playerId);
            });

            // Botón para guardar las posiciones en lote
            document.getElementById("save-positions").addEventListener("click", function() {
                let positions = [];
                document.querySelectorAll(".player-icon").forEach(icon => {
                    let id = icon.dataset.id;
                    let left = parseInt(icon.style.left);
                    let top = parseInt(icon.style.top);
                    positions.push({
                        id: id,
                        x: left,
                        y: top
                    });
                });

                fetch(`/players/positions`, {
                        method: "PATCH",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            positions: positions
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error HTTP: " + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert("Posiciones guardadas correctamente.");
                        } else {
                            alert("Error al guardar posiciones.");
                        }
                    })
                    .catch(error => {
                        console.error("Error al guardar posiciones:", error);
                        alert("Error al guardar posiciones. Revisa la consola.");
                    });
            });
        });
    </script>
</x-app-layout>
