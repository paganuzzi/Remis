<table class="table table-condensed">
              <thead>
                  <tr>
                      <th> Movil</th>
                      <th> Viajes</th>
                      <th> Total</th>
                      <th> % Remisera </th>
                      <th> % Coche </th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td> {{Mobiles::find($data[0]->mobiles_id)->numerocoche}} </td>
                      <td> {{$data[0]->viajes}}</td>
                      <td> {{$data[0]->monto}}</td>
                      <td> {{$data[0]->monto*($porcentaje->porcentaje_remisera/100)}}</td>
                      <td> {{$data[0]->monto*((100-$porcentaje->porcentaje_remisera)/100)}}</td>
                  </tr>
              </tbody>
    </table>
