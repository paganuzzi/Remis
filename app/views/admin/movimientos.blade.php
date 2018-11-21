@extends('admin.menuadmin')


@section('contenido')
<div class="col-md-offset-2">
        <table class="table">
          <caption><h3>Movimientos del usuario {{User::find($data[0]->id_users)->nombreapellido}}</h3></caption>
          <thead>
            <th>Accion</th>
            <th>Fecha</th>
          </thead>
          <tbody>
            @foreach($data as $d)
              @if ($d->accion == 'ignoraprogramado' || $d->accion == 'borraprogramado' || $d->accion == 'borraviaje')
                <tr class="danger">
              @else
                <tr>
              @endif
              @if ($d->accion == 'creaviaje')
                  <td>Creo un viaje de <b>{{Viajes::find($d->id_accion)->origen}}</b> a <b>{{Viajes::find($d->id_accion)->destino}}</b> con el movil <b>{{Mobiles::find(Viajes::find($d->id_accion)->mobiles_id)->numerocoche}}</b></td>
              @endif
              @if ($d->accion == 'asignamovil')
                  <td>Al viaje de <b>{{trim(Viajes::find($d->id_accion)->origen)}}</b> a <b>{{trim(Viajes::find($d->id_accion)->destino)}}</b> le asigno el movil <b>{{trim(Mobiles::find(Viajes::find($d->id_accion)->mobiles_id)->numerocoche)}}</b></td>
              @endif
              @if ($d->accion == 'asignadire')
                  <td>Al viaje de <b>{{trim(Viajes::find($d->id_accion)->origen)}}</b> a <b>{{trim(Viajes::find($d->id_accion)->destino)}}</b> le asigno la direccion de destino</td>
              @endif
              @if ($d->accion == 'terminaviaje')
                  <td>Al viaje de <b>{{Viajes::find($d->id_accion)->origen}}</b> a <b>{{Viajes::find($d->id_accion)->destino}}</b> con el movil <b>{{Mobiles::find(Viajes::find($d->id_accion)->mobiles_id)->numerocoche}}</b> lo finalizo </td>
              @endif
              @if ($d->accion == 'creamovil')
                  <td>Creo el movil <b> {{Mobiles::find($d->id_accion)->numerocoche}} </b></td>
              @endif
              @if ($d->accion == 'pausamovil')
                  <td>Pauso el movil <b>{{Mobiles::find($d->id_accion)->numerocoche}}</b></td>
              @endif
              @if ($d->accion == 'activamovil')
                  <td>Activo el movil <b>{{Mobiles::find($d->id_accion)->numerocoche}}</b></td>
              @endif
              @if ($d->accion == 'cierramovil')
                  <td>Cerró el movil <b>{{Mobiles::find($d->id_accion)->numerocoche}}</b></td>
              @endif
              @if ($d->accion == 'creaprogramado')
                  <td>Creo el viaje programado desde <b>{{Programados::find($d->id_accion)->origen}}</b> a las <b>{{date('d-m H-i', strtotime(Programados::find($d->id_accion)->fecha_despacho))}}</b></td>
              @endif
              @if ($d->accion == 'editaprogramado')
                  <td>Edito el viaje programado desde <b>{{Programados::find($d->id_accion)->origen}}</b> a las <b>{{date('d-m H-i', strtotime(Programados::find($d->id_accion)->fecha_despacho))}}</b></td>
              @endif
              @if ($d->accion == 'asignaprogramado')
                  <td>Creo el viaje desde el programado <b>{{Programados::find($d->id_accion)->origen}}</b> a las <b>{{date('d-m H-i', strtotime(Programados::find($d->id_accion)->fecha_despacho))}}</b></td>
              @endif
              @if ($d->accion == 'ignoraprogramado')
                  <td>Ignoro el programado <b>{{Programados::find($d->id_accion)->origen}}</b> a las <b>{{date('d-m H-i', strtotime(Programados::find($d->id_accion)->fecha_despacho))}}</b></td>
              @endif
              @if ($d->accion == 'borraprogramado')
                  <td>Borro un viaje programado</td>
              @endif
              @if ($d->accion == 'borraviaje')
                  <td>Borro un viaje</td>
              @endif
              @if ($d->accion == 'reasignamovil')
                  <td>Reasigno el movil <b>{{Mobiles::find(Viajes::find($d->id_accion)->mobiles_id)->numerocoche}}</b> al viaje de <b>{{Viajes::find($d->id_accion)->origen}}</b> a <b>{{Viajes::find($d->id_accion)->destino}}</b> </td>
              @endif
              @if ($d->accion == 'ingresa')
                  <td>Ingreso al sistema</td>
              @endif
              @if ($d->accion == 'sale')
                  <td>Salio del sistema</td>
              @endif

              <td>{{date('d-m H-i',strtotime($d->created_at))}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{$data->links()}}

</div>
@stop


@section('est_active')
    class="active"
@stop
