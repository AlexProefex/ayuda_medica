<?php

namespace App\Http\Controllers;

use App\Models\UserAdmin;
use App\Models\Pedidos;
use App\Models\PedidosDetail;
use App\Models\Specialty;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Resources\Pedidos\Pedidos as PedidoResource;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

  
        $tables = DB::select("SELECT * from information_schema.columns join information_schema.tables  on information_schema.tables.table_schema = information_schema.columns.table_schema and information_schema.tables.table_name = information_schema.columns.table_name and information_schema.tables.table_type = 'BASE TABLE' where information_schema.columns.column_name = 'updated_at'");
        //$tables = DB::select("SELECT * from information_schema.columns join information_schema.tables  on information_schema.tables.table_schema = information_schema.columns.table_schema and information_schema.tables.table_name = information_schema.columns.table_name and information_schema.tables.table_type = 'BASE TABLE' where information_schema.columns.data_type = 'timestamp' and information_schema.columns.table_schema not in ('information_schema', 'sys','performance_schema', 'mysql') and information_schema.columns.table_schema = 'kiruv3' and information_schema.columns.column_name = 'updated_at' order by information_schema.columns.table_schema,information_schema.columns.table_name");
        //SELECT information_schema.columns.table_name from information_schema.columns join information_schema.tables  on information_schema.tables.table_schema = information_schema.columns.table_schema and information_schema.tables.table_name = information_schema.columns.table_name and information_schema.tables.table_type = 'BASE TABLE' where information_schema.columns.column_name = 'updated_at'
        $string = '';
       foreach ($tables as $table ){
        //dd($table->table_name);
        $resultado[$table->table_name] = DB::select("SELECT * FROM ".$table->table_name);

        if($tables[count($tables)-1]!=$table){
            $string = $string.$table->table_name.', ';
        }
        else{
            $string = $string.$table->table_name;
        }
       }
       $data = DB::select("SELECT * FROM ".$string);

       return $resultado;

        return $data;
        
        $headers = $request->header();

        // or pass parameter to get specific header
        $Domain = $request->header('Domain');
        return $Domain;


        //$users = new UserAdmin();
        $user = UserAdmin::all();
        //$query = UserAdmin::where('idUser','2')->first()->specialityUser;

        //$query =  UserAdmin::find(2)->specialityUser()->first();

        //$query = UserAdmin::find(2)->userSpecialty()
          //          ->first();

        /*$sp = Specialty::
        select('specialties.idSpecialty','specialties.name')
        ->join('speciality_users','speciality_users.idSpecialty','=','specialties.idSpecialty')
        ->where('speciality_users.idUser',20)
        ->get();

        if($sp=='[]')
            return "es nulo".$sp;
        else
            return "no nulo".$sp;
*/
        return PedidoResource::collection($user);
        //$pedidosdetail->pedidos;
  
        
        //return $request->path();
        //->schemeAndHttpHost();
        //->httpHost();
        //->host();
        //->fullUrl();
        //->getAcceptableContentTypes();
        //->header('X-Header-Name', 'default');
        //->bearerToken();
        //->header('X-Header-Name');
        //->ip();

   
        try {
            //code...
            
        $pedidos = Pedidos::where('idUsuario','8')->first()->pedidosdetail;
        return $pedidos;

      
        } catch (\Throwable $th) {
            //throw $th;
            return "error";
        }


        //$pedidos = Pedidos::whereBelongsTo($pedidos)->get();
  

 //       /return $pedidos;


        $pedidosdetail = PedidosDetail::whereBelongsTo($pedidos)->get();
        return $pedidosdetail;
        //return $pedidosdetail->pedidos;
                    //->where('title', 'foo')
                    //->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$Domain = $request->header('Domain');
        return ['header'=>$request->header(),'body'=>$request->all()];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function show(Pedidos $pedidos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedidos $pedidos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedidos $pedidos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedidos $pedidos)
    {
        //
    }
}
