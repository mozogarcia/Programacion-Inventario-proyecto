@extends("maestra")
@section("titulo", "Responsables")
@section("contenido")
    <div id="app" class="container" v-cloak>
        <div class="columns">
            <div class="column">
                <div class="notification">
                    <div class="columns is-vcentered bg-c-red">
                        <div class="column">
                            @verbatim
                                <h4 class="is-size-4 has-text-white">Responsables ({{paginacion.total}})</h4>
                            @endverbatim
                        </div>
    
                        <div class="column ">
                            <div class="field is-grouped is-pulled-right">
                                <div class="control">
                                    <a href="{{route("formularioAgregarResponsable")}}" class="button is-link">Agregar</a>
                                </div>
                                <div class="control">
                                    @verbatim
                                        <transition name="bounce">
                                            <button @click="eliminarMarcados()" v-show="numeroDeElementosMarcados > 0"
                                                    class="button is-warning"
                                                    :class="{'is-loading': cargando.eliminandoMuchos}">
                                                Eliminar ({{numeroDeElementosMarcados}})
                                            </button>
                                        </transition>
                                    @endverbatim
                                </div>
                            </div>
                            &nbsp;
                        </div>
                    </div>
                </div>

        
            
                @include("errores")
                @include("notificacion")
                <div>

                    <table v-show="responsables.length > 0 && !cargando.lista" class="table is-bordered is-striped is-hoverable is-fullwidth">
                        <thead >
                        <tr>

                            <th>Proveedor</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Contacto</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @verbatim
                            <tr v-for="responsable in responsables">
                             
                                <td>{{responsable.area.nombre}}</td>
                                <td>{{responsable.nombre}}</td>
                                <td>{{responsable.direccion}}</td>
                                <td>{{responsable.contacto}}</td>
                                <td>{{responsable.telefono}}</td>
                                <td>{{responsable.email}}</td>
                                <td>
                                    <button @click="editar(responsable)" class="button is-warning">
                                    <span class="icon is-small">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                    </button>
                                </td>
                                <td>
                                    <button @click="eliminar(responsable)" class="button is-danger"
                                            :class="{'is-loading': responsable.eliminando}">
                                    <span class="icon is-small">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                    </button>
                                </td>
                            </tr>
                        @endverbatim
                        </tbody>
                    </table>
              
                </div>
            </div>
        </div>
    </div>
    <script src="{{url("/js/responsables/mostrar.js?q=") . time()}}"></script>
@endsection
