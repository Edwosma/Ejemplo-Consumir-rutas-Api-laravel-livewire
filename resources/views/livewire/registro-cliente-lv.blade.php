<div>
    <div class="container">
        <div class="form-container">
            @if (session()->has('messageSuccess'))
                <div class="alert alert-success" style="color: white;">
                    {{ session('messageSuccess') }}                    
                </div>        
                <script>
                        setTimeout(function() {
                            document.querySelector('.alert').style.display = 'none';
                        }, 5000); // 30000 milisegundos = 30 segundos
                </script>        
            @endif
            @if (session()->has('message'))
                <div class="alert custom-alert" style="color: white;">
                    {{ session('message') }}                    
                </div>                                
            @endif
            <div class="card">
                <div class="card-body">
                @if($bandIniciarSesion)
                    <form wire:submit.prevent="submitInicioSesion"method="post">
                        @csrf
                        <div class="text-center">
                            <h1>{{__('messages.iniciarSesion') }}</h1>
                            <h4>{{__('messages.clientes') }}</h4><br>
                        </div> 
                        <div class="mb-3">
                            <label for="nombre">Nombre*:</label>
                            <input type="text" class="form-control" id="nombre" wire:model="nombre" name="nombre" pattern="[A-Za-zÁáÉéÍíÓóÚúñÑ\s]+" placeholder="Ingrese su Nombre" required>
                        </div>                         
                        <div class="mb-3">
                            <label for="correo">Correo*:</label>
                            <input type="email" class="form-control" id="correo" wire:model="correo" name="correo" placeholder="example@hotmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="contrasena">Contraseña*:</label>
                            <input type="password" class="form-control" id="contrasena" wire:model="contraseña" name="contrasena" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmarContrasena">Confirmar Contraseña*:</label>
                            <input type="password" class="form-control" id="confirmarContrasena" wire:model="confirmarContrasena" name="confirmarContrasena" required>
                        </div>  
                        <div id="terminosError" style="color: red;"></div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Iniciar</button>                           
                        </div>                        
                        <div class="text-center">
                            <p>No tiene cuenta todavia?</p>  
                            <button type="button" class="btn btn-primary" wire:click="registrarCliente">Crear una cuenta</button>      
			            </div>
                    </form>
                    @endif
                    @if($bandRegistro)
                    <form wire:submit.prevent="submitForm"method="post">
                        @csrf
                        <h1>{{__('messages.registroClientes') }}</h1><br>
                        <div class="mb-3">
                            <label for="nombre">Nombre*:</label>
                            <input type="text" class="form-control" id="nombre" wire:model="nombre" name="nombre" pattern="[A-Za-zÁáÉéÍíÓóÚúñÑ\s]+" placeholder="Ingrese su Nombre" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="documento">Documento*:</label>
                            <input type="text" class="form-control" id="documento" wire:model="documento" name="documento" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaNacimiento">Fecha de Nacimiento*:</label>
                            <input type="date" class="form-control" id="fechaNacimiento" wire:model="fechaNacimiento" name="fechaNacimiento" required>
                        </div>
                        <div class="mb-3">
                            <label for="correo">Correo*:</label>
                            <input type="email" class="form-control" id="correo" wire:model="correo" name="correo" placeholder="example@hotmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmarcorreo">Confirmar Correo*:</label>
                            <input type="email" class="form-control" id="confirmarcorreo" wire:model="confirmarcorreo" name="confirmarcorreo" placeholder="example@hotmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="contrasena">Contraseña*:</label>
                            <input type="password" class="form-control" id="contrasena" wire:model="contraseña" name="contrasena" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmarContrasena">Confirmar Contraseña*:</label>
                            <input type="password" class="form-control" id="confirmarContrasena" wire:model="confirmarContrasena" name="confirmarContrasena" required>
                        </div>
                        <div class="mb-3">
                            <input type="checkbox" id="aceptarTerminos" wire:model="aceptarTerminos" required>
                            <label for="aceptarTerminos">Acepto los <a href="#">Términos y Condiciones</a></label>
                        </div>
                        <div class="mb-3">
                            <input type="checkbox" id="aceptarTratamientoDatos" wire:model="aceptarTratamientoDatos" required>
                            <label for="aceptarTratamientoDatos">Acepto el tratamiento de mis datos personales</label>
                        </div>
                        <div id="terminosError" style="color: red;"></div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                            <button type="button" class="btn btn-success " wire:click="iniciarSesion">iniciarSesion</button>                            
                        </div>
                    </form>
                    @endif
                </div>
               
            </div>
        </div>
    </div>
</div>

<!-- Tu JavaScript personalizado sigue aquí -->



<script>
    const nombreInput = document.getElementById("nombre");

    nombreInput.addEventListener("input", function () {
        const valor = nombreInput.value;
        const soloLetras = /^[A-Za-zÁáÉéÍíÓóÚúñÑ\s]+$/.test(valor);

        if (!soloLetras) {
            nombreInput.value = valor.replace(/[^A-Za-zÁáÉéÍíÓóÚúñÑ\s]/g, ''); 
            nombreInput.setCustomValidity("Solo se permiten letras y espacios.");
        } else {
            nombreInput.setCustomValidity("");
        }
    });

    nombreInput.addEventListener("keypress", function (event) {
        const charCode = event.which || event.keyCode;

        
        if ((charCode >= 48 && charCode <= 57)) { 
            event.preventDefault();
            nombreInput.setCustomValidity("No se permiten números en el nombre.");
        } else {
            nombreInput.setCustomValidity("");
        }
    });
</script>
<script>
    const tipoDocumento = document.getElementById("tipoDocumento");
    const documento = document.getElementById("documento");

    tipoDocumento.addEventListener("change", function () {
        const valor = tipoDocumento.value;

        if (valor === "nit") {
            documento.pattern = "\\d{8,10}";
            documento.title = "Ingresa un NIT válido (8-10 dígitos).";
        } else if (valor === "cedula") {
            documento.pattern = "\\d{6,10}";
            documento.title = "Ingresa una Cédula válida (6-10 dígitos).";
        } else if (valor === "pasaporte") {
            documento.pattern = "^[0-9.]*$"; 
            documento.title = "Ingresa un Pasaporte válido (solo números y un punto).";
        }
    });

    documento.addEventListener("input", function () {
        const valor = documento.value;
        const soloNumerosYPunto = /^[0-9.]*$/.test(valor);

        if (!soloNumerosYPunto) {
            documento.value = valor.replace(/[^0-9.]/g, ''); 
        }
    });
</script>
<script>
    const fechaNacimientoInput = document.getElementById("fechaNacimiento");

    fechaNacimientoInput.addEventListener("input", function () {
        const fechaNacimiento = new Date(fechaNacimientoInput.value);
        const fechaActual = new Date();
        const edadMinima = 18; 

        const edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();

        if (edad < edadMinima) {
            fechaNacimientoInput.setCustomValidity("Debes ser mayor de 18 años para registrarte.");
        } else {
            fechaNacimientoInput.setCustomValidity("");
        }
    });
</script>
<script>
const aceptarTerminos = document.getElementById("aceptarTerminos");
const aceptarTratamientoDatos = document.getElementById("aceptarTratamientoDatos");
const terminosError = document.getElementById("terminosError");

aceptarTerminos.addEventListener("change", function () {
    validarTerminosYDatos();
});

aceptarTratamientoDatos.addEventListener("change", function () {
    validarTerminosYDatos();
});

function validarTerminosYDatos() {
    if (aceptarTerminos.checked && aceptarTratamientoDatos.checked) {
        terminosError.textContent = ""; 
        terminosError.style.display = "none";
    } else {
        terminosError.textContent = "Debes aceptar los Términos y Condiciones y el tratamiento de datos para registrarte.";
        terminosError.style.display = "block";
    }
}

</script>
<style>
.custom-alert {
    background-color: #ff6666; /* Rojo más claro */
    color: white; /* Texto en color blanco */
    /* Otros estilos personalizados si es necesario */
}
</style>
<style>
/* Estilo para el botón de Registrar */
.btn-primary {
    background-color: #007BFF; 
    color: white; 
}

/* Estilo para el enlace dentro de los Términos y Condiciones */
#aceptarTerminos + label a {
    text-decoration: none; 
    color: #007BFF; 
}

#aceptarTerminos + label a:hover {
    text-decoration: underline; 
}

/*estilos para los campos del formularuio*/

/* Estilo para el nombre */
#nombre:hover {
    border-color: #333333; 
}
#nombre {
    border: 1px solid   #007BFF; 
    border-radius: 20px; /
    transition: border 0.3s; 
}


/* Estilo para la tipo de documento*/
#tipoDocumento:hover {
    border-color: #333;
}
#tipoDocumento {
    border: 1px solid   #007BFF; 
    border-radius: 20px; /
    transition: border 0.3s; 
}

/* Estilo para el documento*/
#documento:hover {
    border-color: #333;
}
#documento {
    border: 1px solid   #007BFF; 
    border-radius: 20px; /
    transition: border 0.3s; 
}

/* Estilo para la fecha*/
#fechaNacimiento:hover {
    border-color: #333;
}
#fechaNacimiento{
    border: 1px solid   #007BFF; 
    border-radius: 20px; /
    transition: border 0.3s; 
}

/* Estilo para el correo*/
#correo:hover {
    border-color: #333;
}
#correo{
    border: 1px solid   #007BFF; 
    border-radius: 20px; /
    transition: border 0.3s; 
}

#confirmarcorreo:hover {
    border-color: #333;
}
#confirmarcorreo{
    border: 1px solid   #007BFF; 
    border-radius: 20px; /
    transition: border 0.3s; 
}

/* Estilo para la contraseña*/
#contrasena:hover {
    border-color: #333;
}
#contrasena{
    border: 1px solid   #007BFF; 
    border-radius: 20px; /
    transition: border 0.3s; 
}

/* Estilo para confirmar la contraseña*/
#confirmarContrasena:hover {
    border-color: #333;
}
#confirmarContrasena{
    border: 1px solid   #007BFF; 
    border-radius: 20px; /
    transition: border 0.3s; 
}

/*Estilos para los titulos */

/* Estilo para el título "Nombre" */
label[for="nombre"] {
      font-size: 15px;  
    color: #1d1a49; 
    font-weight: bold; 
}



/* Estilo para el título "tipo document" */
label[for="tipoDocumento"] {
    font-size: 15px; 
    color: #1d1a49; 
    font-weight: bold; 
}

/* Estilo para el título "Documento" */
label[for="documento"] {
    font-size: 15px; 
    color: #1d1a49; 
    font-weight: bold; 
}

/* Estilo para el título "Documento" */
label[for="fechaNacimiento"] {
    font-size: 15px;  
    color: #1d1a49; 
    font-weight: bold; 
}

/* Estilo para el título "correo" */
label[for="correo"] {
    font-size: 15px; 
    color: #1d1a49; 
    font-weight: bold; 
}
label[for="confirmarcorreo"] {
    font-size: 15px; 
    color: #1d1a49; 
    font-weight: bold; 
}

/* Estilo para el título "contraseña" */
label[for="contrasena"] {
    font-size: 15px; 
    color: #1d1a49; 
    font-weight: bold; 
}

/* Estilo para el título "contraseña" */
label[for="confirmarContrasena"] {
    font-size: 15px; 
    color: #1d1a49; 
    font-weight: bold; 
}


/* Estilo para los mensajes de error */
#terminosError, 
#nombre:invalid + label:after {
    color: red; /* Color de texto en rojo */
}

/* Estilo para el enlace a los Términos y Condiciones en los mensajes de error */
#terminosError a,
#nombre:invalid + label:after a {
    color: #007BFF; /* Color de enlace azul */
    text-decoration: underline; /* Subrayado */
}

/* Estilos para centrar el formulario horizontalmente */
.form-container {
    max-width: 400px; /* Ancho máximo del formulario */
    margin: 0 auto; /* Centra horizontalmente */
}
</style>
