@extends("maestra")
@section("titulo", "Editar área")
@section("contenido")
    <div class="container">
        <div class="columns">
            <div class="column is-half-tablet">
                <h1 class="is-size-1">Editar proveedor</h1>
                <form method="POST" action="{{route("guardarCambiosDeArea")}}">
                    @method("put")
                    @csrf
                    <input type="hidden" value="{{$area->id}}" name="id">
                    <div class="field">
                        <label class="label">Nombre</label>
                        <div class="control">
                            <input value="{{$area->nombre}}" autocomplete="off" name="nombre" class="input" type="text"
                                   placeholder="Nombre">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Telefono</label>
                        <div class="control">
                            <input value="{{$area->telefono}}" autocomplete="off" name="telefono" class="input" type="text"
                                   placeholder="Telefono">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Direccion</label>
                        <div class="control">
                            <input value="{{$area->direccion}}" autocomplete="off" name="direccion" class="input" type="text"
                                   placeholder="Direccion">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Correo</label>
                        <div class="control">
                            <input value="{{$area->correo}}" autocomplete="off" name="correo" class="input" type="email"
                                   placeholder="Correo">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Contacto</label>
                        <div class="control">
                            <input value="{{$area->contacto}}" autocomplete="off" name="contacto" class="input" type="text"
                                   placeholder="Contacto">
                        </div>
                    </div>

                    @include("errores")
                    @include("notificacion")
                    <button class="button is-success">Guardar</button>
                    <a class="button is-primary" href="{{route("areas")}}">Ver proveedores</a>
                </form>
                <br>
            </div>
        </div>
@endsection
