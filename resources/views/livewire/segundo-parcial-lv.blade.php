<div>
    <div class="ecommerce-banner grid-margin">
        <div class="bg-dark p-4 text-white">
            <div class="d-lg-flex justify-content-between align-items-center">
                <div class="d-lg-flex align-items-center">
                    <div>
                        <h4 class="mb-2 font-weight-bold text-white mt-3 mt-lg-0">Segundo parcial Aranda: Examen</h4>
                    </div>
                </div>
                @if (!$banPresentarExamen && !$banModificarParcial)
                <div class="d-flex mt-3 mt-lg-0">
                    <button class="mt-1 btn btn-info btn-lg" wire:click="presentarExamen">Presentar Parcial</button>
                </div>
                <div wire:loading wire:target="presentarExamen">
                    Cargando...
                </div>
                @endif
                @if (!$banModificarParcial && !$banPresentarExamen)
                <div>
                    <button class="mt-1 btn btn-warning btn-lg" wire:click="ajustarParcial">Ajustar Parcial</button>
                </div>
                <div wire:loading wire:target="estadoCancelar">
                    Cargando...
                </div>
                @endif
                @if (!$banModificarParcial && $banPresentarExamen)
                <div>
                    <button class="mt-1 btn btn-warning btn-lg" wire:click="salirPresentarParcial">Salir</button>
                </div>
                <div wire:loading wire:target="estadoCancelar">
                    Cargando...
                </div>
                @endif
            </div>
        </div>
    </div>

    @if ($banPresentarExamen)
    <div>
        <section class="form-register">
            <h4>Formulario de ingreso</h4>
            <input class="controls" type="text" wire:model="identificacionUsuario" placeholder="Ingrese su Identificación">
            <button class="botons" wire:click="validacionUsuario">Continuar</button>
        </section>
        <div wire:loading wire:target="validacionUsuario">
            Cargando...
        </div>
        <hr width="0%" />
        <h4>{{ $mensaje }}</h4>
        <hr width="0%" />
        @if ($bandExamen)
        <div class="col-sm-12 col-md-12" style="margin-top: 20px;">
    <div class="card-header">
        <h6 class="mb-0">Examen:</h6>
    </div>
    <form wire:submit.prevent="enviarRespuestas">
        @foreach ($preguntas2 as $index => $pregunta)
            <div class="pregunta">
                <p>{{ $pregunta['pregunta'] }}</p>
                @if (array_key_exists('info', $pregunta))
                    <p>{{ $pregunta['info'] }}</p>
                @endif
                @foreach ($pregunta['opciones'] as $opcion)
                    <label>
                        <input type="radio" wire:model="respuestas.{{ $index }}" value="{{ $opcion['opcion'] }}">
                        {{ $opcion['opcion'] }}
                    </label>
                @endforeach
            </div>
        @endforeach
        <button type="submit">Finalizar y enviar</button>
    </form>
</div>


        @endif
        <div>
        @if ($examenFinalizado)
            <p>Calificación: {{ $calificacion }} / 10</p>
            @endif
        </div>
    </div>
    @endif

    @if ($banModificarParcial)
    <div class="col-sm-12 col-md-12">
        <div class="card border-info mb-0">
            @if (session()->has('dataSaved'))
            <div class="alert alert-success">
                Los datos se han guardado con éxito.
            </div>
            @endif
            <div class="card-body">
                <h5>Ajustes Examen:</h5>
                <hr width="100%" />
                <div class="media">
                    <i class="fas fa-book"></i>
                    <div class="media-body">
                        <p class="Respuestas">
                        </p>
                        @if (!$isFileLoaded)
                        <div>
                            <input type="file" id="fileInput" wire:model="jsonFile" accept=".json">
                            <button onclick="loadFile()">Cargar respuestas JSON</button>
                        </div>
                        @else
                        <p>Nombre del archivo: {{ $jsonFile->getClientOriginalName() }}</p>
                        <button wire:click="processJsonData" wire:loading.attr="disabled">Procesar documento</button>
                        @endif
                    </div>
                </div>
                <hr width="0%" />
                <div class="media">
                    <i class="fas fa-book"></i>
                    <div class="media-body">
                        <p class="Preguntas">
                        </p>
                        @if (!$isFileLoadedPreguntas)
                        <div>
                            <input type="file" id="filePreguntasInput" wire:model="jsonFilePreguntas" accept=".json">
                            <button onclick="loadFilePreguntas()">Cargar Preguntas JSON</button>
                        </div>
                        @else
                        <h2>Documento JSON Preguntas*:</h2>
                        <p>Nombre del archivo: {{ $jsonFilePreguntas->getClientOriginalName() }}</p>
                        <button wire:click="processJsonDataPreguntas" wire:loading.attr="disabled">Procesar documento</button>
                        @endif
                    </div>
                </div>
                <hr width="0%" />
                <i class="far fa-clock align-self-center"></i>
                <p>Duracion del examen (min):</p>
                <div class="media-body">
                    <p class="Tiempo de espera para disparar la alerta (min)*:">
                    </p>
                    <div class="media">
                        <div class="col-sm-12 col-md-12">
                            <input wire:model.lazy="tiempoEsperaInput" type="text" class="form-control border border-2 p-2"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"></input>
                        </div>
                    </div>
                </div>
            </div>
            <hr width="0%" />
            <button type="button" class="btn btn-secondary btn-block text-white" wire:click="cancelarConfiguracion">Cancelar</button>
            <button type="button" class="btn btn-success btn-block text-white" wire:click="finalizarConfiguracion">Guardar
            </button>
            <div wire:loading wire:target="finalizarConfiguracion">
                Creando Examen...
            </div>
        </div>
        <div class="col-sm-12 col-md-12" style="margin-top: 20px;">
            <div class="card-header">
                <h6 class="mb-0">Respuestas Cargadas:</h6>
            </div>
            @if ($dataProcessed)
            @if ($answers)
            @foreach ($answers as $answer)
            @foreach ($answer['answersKey'] as $question => $response)
            <p>Pregunta: {{ $question }}</p>
            <p>Respuesta: {{ $response }}</p>
            @endforeach
            @endforeach
            @else
            <p>No se han cargado respuestas válidas.</p>
            @endif
            @endif
            <div class="card-header">
                <h6 class="mb-0">Examen Cargado:</h6>
            </div>
            @if ($dataProcessedPreguntas)
            @if ($preguntas)
            @foreach ($preguntas[0]['questions'] as $question)
            <p>Pregunta: {{ $question['question'] }}</p>
            <p>Información: {{ $question['info'] }}</p>
            <p>Opciones:</p>
            <ul>
                @foreach ($question['options'] as $option)
                <li>{{ $option }}</li>
                @endforeach
            </ul>
            @endforeach
            @else
            <p>No se han cargado preguntas válidas.</p>
            @endif
            @endif
        </div>
        </div>
    </div>
    @endif
</div>

<script>
function loadFile() {
    console.log('Cargando archivo...'); // Agrega esta línea
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];

    if (file) {
        const formData = new FormData();
        formData.append('jsonFile', file);

        fetch('{{ route('uploadRespuestas.json') }}', { // Utiliza la función 'route' para generar la URL
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Livewire.emit('fileLoaded');
            } else {
                console.error('Error en la carga del archivo:', data.error); // Agrega esta línea
            }
        });
    }
}
</script>
<script>
function loadFilePreguntas() {
    console.log('Cargando preguntas...'); // Agrega esta línea
    const filePreguntasInput = document.getElementById('filePreguntasInput');
    const file = filePreguntasInput.files[0];

    if (file) {
        const formData = new FormData();
        formData.append('jsonFilePreguntas', file);

        fetch('{{ route('upload.json') }}', { // Utiliza la función 'route' para generar la URL
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Livewire.emit('fileLoadedPreguntas');
            } else {
                console.error('Error en la carga del archivo:', data.error); // Agrega esta línea
            }
        });
    }
}
</script>
