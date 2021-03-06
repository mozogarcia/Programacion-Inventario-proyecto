@extends("maestra")
@section("titulo", "Agregar responsable")
@section("contenido")
    <div class="container" id="app">
        <div class="columns">
            <div class="column is-half-tablet">
                <h1 class="is-size-1">Agregar responsable</h1>
                <div class="field">
                    <label class="label">Nombre completo</label>
                    <div class="control">
                        <input v-model="responsable.nombre" autocomplete="off" name="nombre" class="input" type="text"
                               placeholder="Nombre del responsable">
                    </div>
                </div>

        

                <div class="field">
                    <label class="label">contacto</label>
                    <div class="control">
                        <input v-model="responsable.contacto" autocomplete="off" name="contacto" class="input" type="text"
                               placeholder="Contacto">
                    </div>
                </div>

                <div class="field">
                    <label class="label">telefono</label>
                    <div class="control">
                        <input v-model="responsable.telefono" autocomplete="off" name="telefono" class="input" type="text"
                               placeholder="Telefono">
                    </div>
                </div>


                <div class="field">
                    <label class="label">Correo electronico</label>
                    <div class="control">
                        <input v-model="responsable.email" autocomplete="off" name="email" class="input" type="email"
                               placeholder="Correo Electronico">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Direccion</label>
                    <div class="control">
                            <textarea v-model="responsable.direccion" class="textarea"
                                      placeholder="Dirección del responsable" name="direccion"
                                      id="direccion" cols="30" rows="3"></textarea>
                    </div>
                </div>



                <nav class="panel">
                    <div class="panel-block">
                        <p class="control">
                            <label class="label">Proveedor</label>
                            <input @focus="mostrar.areas = true" v-model="busqueda"
                                   @keyup="buscarArea()" class="input is-loading" type="text"
                                   placeholder="Buscar Proveedor">
                        </p>
                    </div>
                    @verbatim
                        <a v-show="mostrar.areas && busqueda" @click="seleccionarArea(area)" v-for="area in areas"
                           class="panel-block" :class="{'is-active': area.id === areaSeleccionada.id}">
                            <span class="panel-icon">
                                <i class="fas fa-building" aria-hidden="true"></i>
                            </span>
                            {{area.nombre}}
                        </a>
                        <div v-show="!mostrar.areas && areaSeleccionada.id" class="notification is-info">
                            <h4 class="is-size-4">Área: {{areaSeleccionada.nombre}}</h4>
                        </div>
                </nav>
                <div v-show="errores.length > 0" class="notification is-danger">
                    <h5 class="is-size-5">Por favor, valida los siguientes errores:</h5>
                    <ul>
                        <li v-for="error in errores">
                            {{error}}
                        </li>
                    </ul>
                </div>
                <div v-show="mostrar.aviso" class="notification" :class="aviso.tipo">
                    {{aviso.mensaje}}
                </div>
                @endverbatim
                @include("errores")
                @include("notificacion")
                @verbatim
                    <button :class="{'is-loading':cargando}" @click="guardar()" class="button is-link">Guardar
                    </button>
                @endverbatim
                <a class="button is-primary" href="{{route("responsables")}}">Ver todos</a>
                <br>
            </div>
        </div>
    </div>
    <script src="{{url("/js/responsables/agregar.js?q=") . time()}}"></script>
@endsection
