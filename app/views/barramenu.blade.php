      <nav class="navbar navbar-default" style="background-color:transparent;border:0px;margin-bottom: 0px;" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header" style="padding-bottom: 0px;">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="padding-left: 0px;" href="/">{{Configuraciones::find(1)->nombreremis}}</a>
          @include('admin.aviso.menuprin')
          </div>
          <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav navbar-left">
              <li><a href="/planilla">Planilla Diaria</a></li>
              @if (Auth::user()->usertype == 0)
                  <li><a href="/admin">Administracion</a></li>
              @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
              @if(Auth::check())
                <li class="dropdown" role="presentation">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->nombreapellido}}
                    <span class="caret"></span>
                  </a>
                  <ul id="menu1" class="dropdown-menu" aria-labelledby="drop4">
                    @if (Auth::user()->usertype == 0)
                      <li><a href="/admin">Opciones de Sistema</a></li>
                      <li><a href="/estadisticas">Estadisticas</a></li>
                      <li><a href="/autos">Administrar Autos</a></li>
                      <li><a href="/choferes">Administrar Choferes</a></li>
                      <li><a href="/user">Administrar Usuarios</a></li>
                      <li><a href="/viajes">Buscar Viaje</a></li>
                      <li role="separator" class="divider"></li>
                    @endif
                    <li><a href="/user/{{Auth::user()->id}}/edit">Administrar sus datos</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/pdf/ayuda.pdf" target="_blank">Ayuda</a></li>
                    <li><a href="/salir">Salir</a></li>
                  </ul>
                </li>
              @else
                <li><a href="/pdf/ayuda.pdf" target="_blank">Ayuda</a></li>
                <li><a href="/login">Ingresar</a></li>
              @endif
            </ul>
          </div>
        </div>
      </nav>
