<html lang="ES">
<head>
    @vite(['resources/js/app.js'])
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/extras.css') }}" rel="stylesheet">
    <script
        src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
            integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer" />
    <title>OC FPIU para DT</title>
</head>
<body>
<nav class="navbar ocNav">
    <div class="container-fluid">
        <a href="#menu-toggle" class="btnNav" id="menu-toggle">
            <i class="fa fa-bars btnNavIcon"></i>
        </a>
        <b class="text-light">Formación PIU para DT</b>
    </div>
</nav>

<div id="wrapper" class="toggled">
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <img src="{{ asset('img/ocAci.jpg') }}" width="249px" alt="Img OC ACI">

            <div style="text-align: center; font-size: 16px; margin: 10px">
                        <span class="nav-text">
                            <b class="text-light">{{ Auth::user()->name }}</b><br>
                        </span>
                <span class="nav-text">
                            <b class="text-light">{{ Auth::user()->email }}</b><br>
                        </span>
                <span class="nav-text">
                            <b class="text-light">{{ Auth::user()->telefono }}</b><br>
                        </span>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Opciones
                    </a>
                    <ul class="dropdown-menu" style="background-color: #525252;" aria-labelledby="navbarDropdown">
                        <button type="button" id="editarPerfil" class="dropdown-item buttonDropDown"
                                data-bs-toggle="modal"
                                data-bs-target="#modalUsuariosEdit"><i class="fa fa-user"></i> <b>Editar perfil</b>
                        </button>
                        <button type="button" id="editarPerfil" class="dropdown-item buttonDropDown "
                                data-bs-toggle="modal"
                                data-bs-target="#modalContrasenia"><i class="fa-solid fa-passport"></i> <b>Cambiar
                                contraseña</b>
                        </button>
                    </ul>
                </li>
                <hr/>
                <form action="{{ route("logout") }}" method="post" style="margin-top: 10px">
                    @csrf
                    <button type="submit" id="buttonSalir" class="btnHoverColorWhite"
                            style="width: 200px"><i class="fa-solid fa-arrow-right-from-bracket"></i> <b>Cerrar
                            Sesion</b>
                    </button>
                </form>
            </div>
            <hr style="color: white"/>
            <li>
                <a href="{{ route('home') }}"
                   class="{{ request()->is('home') ? 'active' : '' }} buttonSideBar">
                    <i class="fa fa-home"></i>
                    <span class="nav-text " style="margin-left: 20px">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('FormacionPIUIndex') }}"
                   class="{{ request()->is('seguimiento') ? 'active' : '' }} buttonSideBar">
                    <i class="fa fa-file"></i>
                    <span class="nav-text" style="margin-left: 20px">Formaciones</span>
                </a>
            </li>
            @if(Auth::user()->esAdmin)
                <li>
                    <a href="{{ route('getUsuarios') }}"
                       class="{{ request()->is('getUsuarios') ? 'active' : '' }} buttonSideBar">
                        <i class="fa fa-users"></i>
                        <span class="nav-text" style="margin-left: 20px">Usuarios</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    @include('usuarios.form_editar')
    @include('usuarios.form_contrasenia')
    <div id="page-content-wrapper-oc">
        @yield('content')
    </div>
</div>
</body>
</html>

<script type="text/javascript">
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
