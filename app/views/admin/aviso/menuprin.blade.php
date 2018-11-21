@if (Coches::vencimientos()->count() > 0 || Choferes::vencimientos()->count() > 0)
  <a class="navbar-brand" href="/admin"><span class="text text-danger">!Vencimientos!</span></a>
@endif
@if (Choferes::cumple()->count() > 0)
  <a class="navbar-brand" href="/choferes">
    <span class="text text-success">¡Hay Cumpleaños!</span>
  </a>
@endif
