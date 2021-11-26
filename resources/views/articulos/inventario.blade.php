@extends("maestra")
@section("titulo", "Artículos")
@section("contenido")
    <div id="app" class="container" v-cloak>
        <div class="columns">
            <div class="column">
                <div class="notification  bg-c-red">
                    <div class="columns is-vcentered">
                        <div class="column">
                            @verbatim
                                <h4 class="is-size-4  has-text-white ">Inventario ({{paginacion.total}})</h4>
                            @endverbatim
                        </div>
                        <div class="column">
                            <div class="field has-addons">
                                <div class="control">
                                    <input :readonly="deberiaDeshabilitarBusqueda" v-model="busqueda" @keyup="buscar()"
                                           class="input " type="text"
                                           placeholder="Buscar por nombre">
                                </div>
                                <div class="control">
                                    <button :disabled="deberiaDeshabilitarBusqueda || !busqueda" v-show="!this.busqueda"
                                            @click="buscar()" class="button is-info"
                                            :class="{'is-loading': buscando}">
                                        <span class="icon is-small">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </button>

                                    <button v-show="this.busqueda" @click="limpiarBusqueda()" class="button is-info"
                                            :class="{'is-loading': buscando}">
                                        <span class="icon is-small">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field is-grouped is-pulled-right">
                                <div class="control">
                                    <a href="{{route("formularioAgregarArticulo")}}"
                                       class="button is-success">Agregar</a>
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
                <div v-show="cargando.lista" class="notification is-info has-text-centered">
                    <h3 class="is-size-3">Cargando</h3>
                    <div>
                        <h1 class="icono-gigante">
                            <i class="fas fa-spinner fa-spin"></i>
                        </h1>
                    </div>
                    <p class="is-size-5">
                        Por favor, espera un momento
                    </p>
                </div>
                <transition name="fade">
                    <div v-show="articulos.length <= 0 && !busqueda && !cargando.lista"
                         class="notification is-info has-text-centered">
                        <h3 class="is-size-3">Todavía no hay artículos</h3>
                        <div>
                            <h1 class="icono-gigante">
                                <i class="fas fa-box-open"></i>
                            </h1>
                        </div>
                        <p class="is-size-5">
                            Parece que no has agregado ningún artículo. Registra uno haciendo click en el botón
                            <strong>Agregar</strong>
                        </p>
                    </div>
                </transition>
                <transition name="fade">
                    <div v-show="articulos.length <= 0 && busqueda && !cargando.lista"
                         class="notification is-warning has-text-centered">
                        <h3 class="is-size-3">No hay resultados</h3>
                        <div>
                            <h1 class="icono-gigante">
                                <i class="fas fa-search"></i>
                            </h1>
                        </div>
                        <p class="is-size-5">
                            No hay resultados que coincidan con tu búsqueda
                        </p>
                    </div>
                </transition>
                @include("errores")
                @include("notificacion")
                @verbatim
                    <div class="rows" v-for="grupoDeArticulos in articulos">
                        <div class="row  card bg-c-blue" v-for="articulo in grupoDeArticulos">
                       <table id="example" class="table is-striped">
    
                       
<table  id="example" class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth " >



<tr>
    
      <td>{{articulo.numero_folio_comprobante}}</td>
      <td>{{articulo.descripcion}}</td>
      <td>{{articulo.marca}}</td>
      <td> {{articulo.modelo}}</td>
      <td>{{articulo.serie}}</td>
      <td> {{articulo.costo_adquisicion}}</td>
      <td>{{articulo.Cantidad}}</td>
      <td>{{articulo.costo_adquisicion*articulo.Cantidad}}</td>
      <td>  <p class="control">
                                            <button class="button is-warning" @click="editar(articulo)">
                                             
                                                <span class="icon">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </button>
                                        </p></td>
      <td>        <p class="control">
                                            <button class="button is-danger" @click="eliminar(articulo)">
                                               
                                                <span class="icon">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            </button>
                                        </p></td>
      
    </tr>
                                 
                               
                                
</table>                             
                                   
                                   
                                
                                       

                                       
                                 
                                   
                            </div>
                        </div>
                    </div>
                @endverbatim

            </div>
        </div>
    </div>
    <script src="{{url("/js/articulos/mostrar.js?q=") . time()}}"></script>
@endsection
