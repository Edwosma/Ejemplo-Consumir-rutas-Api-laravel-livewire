<div>
    {{-- The Master doesn't talk, he acts. --}}    
    <div class="ecommerce-banner grid-margin">
        <div class="bg-dark p-4 text-white">
            <div class="d-lg-flex justify-content-between align-items-center">
                <div class="d-lg-flex align-items-center">                        
                    <div>
                        <h4 class="mb-2 font-weight-bold text-white mt-3 mt-lg-0">{{$nombreInforme}}</h4>                            
                    </div>
                </div>                                
            </div>
        </div>
    </div> 
  <!-- resources/views/livewire/perceptron-component.blade.php -->

<!-- resources/views/livewire/perceptron-component.blade.php -->

<!-- resources/views/livewire/perceptron-component.blade.php -->

<div>
    <h1>Enseñar al Perceptron </h1>

    <div>
        <button wire:click="enseñarPerceptron">Enseñar al perceptrón</button>
    </div>

    <!-- Mostrar la matriz como una cuadrícula de casillas de verificación -->
    <div>
        @foreach ($matriz as $fila)
            @foreach ($fila as $valor)
                <input type="checkbox" wire:model="matriz.{{ $loop->parent->index }}.{{ $loop->index }}">
            @endforeach
            <br>
        @endforeach
    </div>

    <div>
        <!-- Nueva entrada para el nombre de la combinación -->
        <label for="nombreCombinacion">Nombre de la Combinación:</label>
        <input type="text" wire:model="nombreCombinacion">
    </div>

    <div>
        <button wire:click="guardarMatriz">Guardar Matriz</button>
    </div>

    <hr>

    <h1>Probar al Perceptrón</h1>

    <div>
        <label for="combinacion">Combinación:</label>
        <input type="text" wire:model="combinacion">
    </div>

    <div>
        <button wire:click="probarPerceptron">Probar Perceptrón</button>
    </div>

    <div>
        <!-- Mostrar la letra o el mensaje del perceptrón -->
        @if ($letraEnseñada)
            <h2>Letra Enseñada: {{ $letraEnseñada }}</h2>
        @else
            <p>Letra no enseñada.</p>
        @endif
    </div>
</div>

</div>    
