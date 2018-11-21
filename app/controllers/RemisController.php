<?php

use Illuminate\Support\Facades\Redirect;
class RemisController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $config = Configuraciones::find(1);


        $mobiles = DB::table('mobiles')
                    ->where('habilitado','=',true)
                    ->where('liquidado','=',false)
                    ->where('estado','=','libre')
                    ->orderBy('updated_at','asc')
                    ->lists('numerocoche','id');

        $query = DB::table('viajes')
                    ->leftjoin('mobiles','mobiles.id','=','viajes.mobiles_id')
                    ->select('programado','destino','notas','numerocoche',db::raw('viajes.id as idviaje'),db::raw('mobiles.id as idmobil'),'origen','viajes.created_at',DB::raw('timediff(now(),viajes.created_at) as tiempoviaje'))
                    ->where('terminado','=','false')
                    ->orderBy('fecha_pedido','asc')
                    ->get();

        $prog = DB::table('programados')
                    ->select('fecha_despacho as fecha', 'despachado','repite', 'notas','id','origen')
                    ->where('despachado','=',0)
                    ->where(DB::raw('date(fecha_despacho)'),'=', DB::raw('curdate()'))
                    ->orwhere(function($query){
        							$query->where('fecha_despacho','<',db::raw('curdate()'))
        										->where('despachado','=',false);
        						})
                    ->get();

        $data = array('data' => $query,'config'=>$config,'mobiles'=>$mobiles,'prog'=>$prog);


        if (Request::ajax()){
            return View::make('actualizatabla',$data);
        }
        else{
            return View::make('remis.principal',$data);
        }
    }

    //Resumen del dia
    public function planilla(){
        $query = DB::table('viajes')
                      ->select(db::raw('count(viajes.id) as viajes'),db::raw('sum(monto) as monto'),'mobiles_id', 'updated_at')
                      ->where('terminado','=',true)
                      ->groupBy('mobiles_id')
                      ->orderBy('updated_at','desc')
                      ->paginate(20);

        $logmoviles = DB::table('logmoviles')
                    ->select(db::raw('sum(gastos) as monto'),'mobil_id')
                    ->groupBy('mobil_id')
                    ->get();
        
        $porcentaje = Configuraciones::find(1);

        $data = array('datos' => $query,'porcentaje'=>$porcentaje,'logmoviles'=>$logmoviles);

        return View::make('planilla',$data);
    }

    //lista los viajes de ese coche en el dia
    public function detalleplanilla($id){

      if (Request::ajax()){
            $movil = Mobiles::find($id);
            $query = DB::table('viajes')
                        ->select('monto','mobiles_id','adeuda','origen','destino','created_at','updated_at','notas')
                        ->whereBetween('viajes.updated_at',[$movil->created_at,$movil->updated_at])
                        ->where('mobiles_id','=',db::raw($id))
                        ->where('terminado','=',true)
                        ->get();
            $data = array('data' => $query,'id'=>$id,'imprime'=>false);
            return View::make('detalleviajes',$data);
       }else{
            return Redirect::to('planilla');
        };

    }

    public function imprdetalleplanilla($id){
          $movil = Mobiles::find($id);
          $query = DB::table('viajes')
                      ->select('monto','mobiles_id','adeuda','origen','destino','created_at','updated_at','notas')
                      ->whereBetween('viajes.updated_at',[$movil->created_at,$movil->updated_at])
                      ->where('mobiles_id','=',db::raw($id))
                      ->where('terminado','=',true)
                      ->get();
          $data = array('data' => $query,'id'=>$id,'imprime'=>true);
          return View::make('detalleviajes',$data);
    }

    public function imprime_ticket($id){

        $movil = Mobiles::find($id);
        $query = DB::table('viajes')
                      ->select(db::raw('count(viajes.id) as viajes'),db::raw('sum(monto) as monto'),'mobiles_id')
                      ->whereBetween('viajes.updated_at',[$movil->created_at,$movil->updated_at])
                      ->where('mobiles_id','=',db::raw($id))
                      ->where('terminado','=',true)
                      ->get();
        $porcentaje = Configuraciones::find(1);

        $logremis = Logmoviles::where('mobil_id','=',$id)->get();

        $data = array('data' => $query,'porcentaje'=>$porcentaje,'logremis'=>$logremis);

        return View::make('remis.imprime_ticket',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

    }





    //termina un viaje
    public function termina($id){
        $input = Input::all();
        $data = Viajes::find($id);

        if ($data->terminado){
            return Redirect::to('/')->with('message', '<div class="alert alert-info" role="alert">El viaje ya fue terminado por otro operador</div>');
        }
        else{
            $mobil = $data->mobiles_id;
            $data->terminado=1;
            $data->monto = $input['monto'];
            if (isset($input['destino']))
                $data->destino = $input['destino'];
            $data->notas = $input['notas'];
            if (Input::get('adeuda'))
                $data->adeuda=true;
            else
                $data->adeuda=false;
            $data->save();
            $log = new Logusuarios;
            $log->nuevolog($data->id,4);

            $data = Mobiles::find($mobil);
            $data->estado = 'libre';
            $data->save();


            return Redirect::to('/')->with('message', '<div class="alert alert-success alert-dismissible" role="alert">Viaje terminado '.$data->numerocoche.' libre</div>');
        }
    }

    //reasigna movil un viaje
    public function reasigna($id){
        $data = Viajes::find($id);
        $input = Input::all();

        if ($data->terminado){
            return Redirect::to('/')->with('message', '<div class="alert alert-info" role="alert">El viaje ya fue terminado por otro operador</div>');
        }
        else{
            if (Mobiles::find($input['coche'])->estado =='libre'){
                $mobil = $data->mobiles_id;
                if ($input['coche']==0){
                  $data->mobiles_id = 0;
                }else{
                  $data->mobiles_id = $input['coche'];
                }
                $data->save();

                $log = new Logusuarios;
                $log->nuevolog($data->id,17);

                $data = Mobiles::find($mobil);
                $data->estado = 'libre';
                $data->save();

                if ($input['coche'] != 0){
                  $data = Mobiles::find($input['coche']);
                  $data->estado = 'ocupado';
                  $data->save();
                }

                if ($input['coche']==0){
                  return Redirect::to('/')->with('message', '<div class="alert alert-success alert-dismissible" role="alert">El viaje quedo sin movil asignado, el movil '.Mobiles::find($mobil)->numerocoche.' esta libre</div>');
                }else{
                  return Redirect::to('/')->with('message', '<div class="alert alert-success alert-dismissible" role="alert">El viaje cambio al movil '.Mobiles::find($input['coche'])->numerocoche.', el movil '.Mobiles::find($mobil)->numerocoche.' esta libre</div>');
                }
            }else {
              return Redirect::to('/')->with('message', '<div class="alert alert-danger alert-dismissible" role="alert">El movil '.Mobiles::find($input['coche'])->numerocoche.' no esta libre</div>');
            }
        }
    }


    //asigna un movil a un viaje
    public function asignaviaje($idviaje){
            //asigno viaje a mobil
            $data = Input::all();
            $viaje = Viajes::find($idviaje);
            $mobil = Mobiles::find($data['coche']);


            if ($mobil->estado=='libre'){
              $viaje->mobiles_id = $data['coche'];
              $viaje->created_at = Carbon::now();
              $viaje->programado = false;
              $viaje->save();

              $log = new Logusuarios;
              $log->nuevolog($viaje->id,2);


              //pongo el mobil en viaje
              $mobil->estado = 'ocupado';
              $mobil->save();
              return Redirect::to('/');
            }
            else{
              return Redirect::to('/')->with('message', '<div class="alert alert-danger" role="alert">El movil '.$mobil->id.' no esta libre</div>');
            }


    }

    //asigna un destino a un viaje
    public function asignadestino($idviaje){
        $data = Input::all();
        $viaje = Viajes::find($idviaje);
        $viaje->destino = $data['destino'];
        $viaje->save();

        $log = new Logusuarios;
        $log->nuevolog($viaje->id,3);

        return Redirect::to('/');
    }


    //verifico si tiene destino para el form de termina viaje
    public function destinoviaje($idviaje){
        if (Request::ajax()){
            $viaje = Viajes::find($idviaje);
            if ($viaje->destino)
                return $viaje->destino;
            else
                return 0;
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {

        $input = Input::all();
        //valido que el numero de coche no este en viaje
        $data = Viajes::whereraw('mobiles_id = '.$input['coche'].' and mobiles_id<>0 and terminado = false')->count();

        if ($data==0){
            $data = new Viajes;
            $data->origen =  $input['origen'];
            $data->destino = $input['destino'];
            $data->fecha_pedido = Carbon::now();
            if ($input['coche']<>0){
                $data->mobiles_id = $input['coche'];
            }
            $data->notas = $input['notas'];
            $data->save();

            $log = new Logusuarios;
            $log->nuevolog($data->id,1);

            if ($input['coche']<>0){
                $data = Mobiles::find($input['coche']);
                $data->estado='ocupado';
                $data->save();
            }
            return Redirect::to('/');
        }
        else
            Input::flash();
            return Redirect::to('/')->with('message', '<div class="alert alert-danger" role="alert">El auto esta en viaje, no puede recibir un nuevo destino.</div>');
        }

    //borra un viaje adeudado
    public  function borraadeudado($id){
      $viaje = Viajes::find($id);
      $viaje->adeuda = false;
      $viaje->save();

      $movil = Mobiles::find($viaje->mobiles_id)->touch();
      return Redirect::back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */


    public function show($id) {
      if (Request::ajax()){
        $viaje = DB::table('viajes')
                    ->leftjoin('mobiles','mobiles.id','=','viajes.mobiles_id')
                    ->select('programado','destino','notas','numerocoche',db::raw('viajes.id as idviaje'),db::raw('mobiles.id as idmobil'),'origen','viajes.created_at',DB::raw('timediff(now(),viajes.created_at) as tiempoviaje'))
                    ->where('terminado','=','false')
                    ->where('numerocoche','=',$id)
                    ->orderBy('created_at','asc')
                    ->get();
       $config = Configuraciones::find(1);
       if ($viaje){
         return View::make('actualizatabla',['data'=>$viaje,'prog'=>false,'config'=>$config]);
       }else{
         return 0;
       }
     }else {
       return Redirect::to('/');
     }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function destroy() {
        $data = Input::all();
        $viaje = Viajes::find($data['idborraviaje']);
        $viaje->delete();

        $log = new Logusuarios;
        $log->nuevolog($viaje->id,16);

        return Redirect::back();
    }


}
