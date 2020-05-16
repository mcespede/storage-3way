<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Le quitamos el 'auth' y le agregamos el 'web' para que no se necesite autenticacion para ver los videos pero si para modificarlos
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

//----------------------------------------------------------------------------------------
//--------------------------------INDEX ---------------------------------------------
//----------------------------------------------------------------------------------------

    public function index()
    {
        //-------------PAGINATE----------------//
        /*Hay varias formas de hacerlo. Lo puedo hacer con el QUERY builder utilizando el metodo DB. EN este caso NO tengo que importar el modelo de USER

        $videos = DB::table('videos')->paginate(5);
        return view('home');
        */
        /*Tambien lo puedo hacer utilizando el modelo, de esta forma debo de importar el modelo VIDEO en el controlador. Tambien utilizo el ORDER BY para ordenar los videos de mas nuevo a mas antiguo*/
        //$videos = Video::orderBy('id','desc')-> paginate(5);
        /*Ahora le tengo que pasar la informacion a la vista, para eso le paso un array al VIEW*/

        return view ('mainView/home',array(
            /*Creo un indice VIDEOS y le paso todos los videos, de esta forma ya tengo accesible todos los videos en la vista home*/
            //'videos' =>$videos
        ));

    }

}
