
<div class="col-md-7">
  <table class="table table-hover">
    <tbody>
        <thead>
          <tr>
            <th>De:</th>
            <th>Contenido</th>
            <th>Fecha</th>
          </tr>
        </thead>
        @foreach($sms as $s)
          @if($s->leido)
            <tr class="clickmail" idsms="{{$s->id}}">
          @else
            <tr class="info clickmail"  idsms="{{$s->id}}">
          @endif
              <td>{{User::find($s->desde)->nombreapellido}}</td>
              <td>{{$s->sms}}</td>
              <td>{{date('d-m h:m',strtotime($s->created_at))}}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
