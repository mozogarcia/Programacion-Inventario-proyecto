@extends("maestra")
@section("titulo", "Agregar artículo")
@section("contenido")
    <div class="container" id="app">
        <div class="columns">
            <div class="column">
                <h1 class="is-size-1">Agregar artículo</h1>

                <hr>
                <div class="field is-horizontal">
                    <div class="field-body">
                        <div class="field">
                            <label class="label">Fecha de adquisición</label>
                            <div class="control">
                                <input v-model="articulo.fechaAdquisicion" autocomplete="off" class="input" type="date">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Código de producto</label>
                            <div class="control">
                                <input placeholder="Código" v-model="articulo.codigo" autocomplete="off"
                                       class="input" type="text">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Numero de invoice</label>
                            <div class="control">
                                <input placeholder="numero " v-model="articulo.numeroFolioComprobante"
                                       autocomplete="off"
                                       class="input" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <label class="label">Cliente</label>
                            <div class="control">
                                <input placeholder="nombre de cliente" v-model="articulo.marca" autocomplete="off"
                                       class="input" type="text">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Estilo</label>
                            <div class="control">
                                <input placeholder="Estilo" v-model="articulo.modelo" autocomplete="off"
                                       class="input" type="text">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Item</label>
                            <div class="control">
                                <input placeholder="Nombre item" v-model="articulo.serie"
                                       autocomplete="off" class="input" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Descripción</label>
                            <div class="control">
                                <textarea v-model="articulo.descripcion" placeholder="Describe el artículo" cols="30"
                                          rows="6" class="textarea"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="columns">
                    <div class="column">
                        <div class="field is-horizontal">
                            <div class="field-body">
                                <div class="field">
                                    <label class="label">Estado</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select v-model="articulo.estado">
                                                <option value="regular">Regular</option>
                                                <option value="malo">Rechazado</option>
                                                <option value="inservible">Averia</option>
                                                <option value="noEncontrado">No encontrado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Monto</label>
                                    <div class="control">
                                        <input placeholder="Precio" v-model="articulo.costoAdquisicion"
                                               autocomplete="off"
                                               class="input" type="number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <nav class="panel">
                            <div class="panel-block">
                                <p class="control">
                                    <label class="label">Área</label>
                                    <input @focus="mostrar.areas = true" v-model="busqueda"
                                           @keyup="buscarArea()" class="input" type="text"
                                           placeholder="Buscar área">
                                </p>
                            </div>
                            @verbatim
                                <a v-show="mostrar.areas && busqueda" @click="seleccionarArea(area)"
                                   v-for="area in areas"
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
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Observaciones</label>
                            <div class="control">
                                <textarea v-model="articulo.observaciones"
                                          placeholder="Observaciones que el artículo tenga" cols="30"
                                          rows="4" class="textarea"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

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
                    <button :class="{'is-loading':cargando}" @click="guardar()" class="button is-success">Guardar
                    </button>
                @endverbatim
                <a class="button is-primary" href="{{route("articulos")}}">Ver todos</a>
                <br>
            </div>
        </div>
    </div>
    <script src="{{url("/js/articulos/agregar.js?q=") . time()}}"></script>
@endsection
