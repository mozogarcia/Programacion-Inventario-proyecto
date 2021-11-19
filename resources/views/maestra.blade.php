<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("titulo")</title>
    <link rel="stylesheet" href="{{url("/css/estilos.css")}}">
    <link rel="stylesheet" href="{{url("/css/all.min.css")}}">
    <link rel="stylesheet" href="{{url("/css/bulma.min.css")}}"/>
    <script type="text/javascript">
        const URL_BASE = "{{url("/")}}",
            URL_BASE_API = "{{url("/api")}}",
            TOKEN_CSRF = "{{csrf_token()}}";
    </script>
    <script src="{{url("/js/principal.js?q=") . time()}}"></script>
    <script src="{{url("/js/wireframe.js?q=") . time()}}"></script>
    <script src="{{url("/js/utiles.js")}}"></script>
    <script src="{{url("/js/vue.js")}}"></script>


    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css"
  integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
  



    
</head>

<body>
@if(Auth::check())
    <nav class="navbar bg-gris ;">
        <div class="navbar-brand">
            <a class="navbar-item" href="#">
                <img class="logo" style="max-height: 100%;" src="{{url("/img/logo1.png") }}"
                     alt="Aquí el logotipo de la empresa"
                     width="150" height="20">
            </a>
            <div id="intercambiarMenu" class="navbar-burger burger" data-target="menuPrincipal">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="menuPrincipal" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item has-text-black" href="{{ route("areas") }}">
                    <span class="icon has-text">
                        <i class="fa fa-home"></i>
                    </span>&nbsp;Proveedor
                </a>
                <a class="navbar-item has-text-black" href="{{ route("responsables") }}">
                    <span class="icon has-text-Success">
                        <i class="fa fa-users"></i>
                    </span>&nbsp;Encargados
                </a>
                <a class="navbar-item has-text-black" href="{{ route("articulos") }}">
                    <span class="icon has-text-Success">
                    <i class="fas fa-dolly-flatbed"></i>
                    </span>&nbsp;Detalle de productos
                </a>

                <a class="navbar-item has-text-black" href="{{ route("inventario") }}">
                    <span class="icon has-text-Success">
                    <i class="fas fa-boxes"></i>
                    </span>&nbsp;inventario
                </a>
                
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="field is-grouped">
                        <a class="button"
                           href="{{route("logout")}}">
                            <strong>Salir</strong>&nbsp;({{Auth::user()->nombre}})
                            <span class="icon has-text-info">
                                <i class="fa fa-sign-out-alt"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endif
<section class="section" style="padding-top: 0.3rem;">
    @yield("contenido")

    </table>
  

    <script type="text/javascript">

$('#example').DataTable( {
        dom: 'Bfrtip',
        
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    </script>
</section>
</body>

</html>
