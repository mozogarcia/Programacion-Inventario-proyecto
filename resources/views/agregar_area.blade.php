@extends("maestra")
@section("titulo", "Agregar área")
@section("contenido")
    <div class="container">
        <div class="columns">
            <div class="column is-half-tablet">
                <h1 class="is-size-1">Agregar Proveedores</h1>

                <hr>
                <form method="POST" action="{{route("guardarArea")}}">
                    @csrf
                    <div class="field">
                        <label class="label">Nombre</label>
                        <div class="control">
                            <input autocomplete="off" name="nombre" class="input" type="text"
                                   placeholder="Nombre de proveedor">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Telefono</label>
                        <div class="control">
                            <input autocomplete="off" name="telefono" class="input" type="text"
                                   placeholder="telefono    ">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Direccion</label>
                        <div class="control">
                            <input autocomplete="off" name="direccion" class="input" type="text"
                                   placeholder="Direccion    ">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Correo</label>
                        <div class="control">
                            <input autocomplete="off" name="correo" class="input" type="email"
                                   placeholder="Correo    ">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Contacto</label>
                        <div class="control">
                            <input autocomplete="off" name="contacto" class="input" type="text"
                                   placeholder="contacto    ">
                        </div>
                    </div>
                    @include("errores")
                    @include("notificacion")
                    <button class="button is-success">Guardar</button>
                    <a class="button is-primary" href="{{route("areas")}}">Ver Proveedores</a>
                </form>
                <br>
            </div>
        </div>
    </div>
@endsection
