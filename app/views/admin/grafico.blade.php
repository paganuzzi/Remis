<script type="text/javascript">
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer",
        {
            animationEnabled: true,
            title:{
                text: "Rendimiento Mes a Mes"
            },

            axisX:{
                labelAutoFit: true,
                labelWrap:true,
                labelAngle: 0,
                labelMaxWidth:50
            },

            data: [
            {
                type: "bar", //change type to bar, line, area, pie, etc
                dataPoints: [
                    @foreach($grafico as $v)
                      { label: "{{$meses[$v->mes_viaje]}}", y: {{round($v->suma_viajes*($config->porcentaje_remisera/100),2)}} },
                    @endforeach

                ]
            }
            ]
            });

        chart.render();
    }
    </script>
    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
