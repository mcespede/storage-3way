<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Video;
use App\Audio;
use App\Doc;

class LandingPage extends Controller
{

        public function __construct()
    {
        //Le quitamos el 'auth' y le agregamos el 'web' para que no se necesite autenticacion para ver los videos pero si para modificarlos
        $this->middleware('web');
    }
    
////////////   Landing PAGE /////////////////
    public function index()
    {
        return view ('welcome',array(
        ));
    }

////////////   SHOW VIDEOS- /////////////////
        public function videos()
    {
        //-------------PAGINATE----------------//
        /*Hay varias formas de hacerlo. Lo puedo hacer con el QUERY builder utilizando el metodo DB. En este caso NO tengo que importar el modelo de USER

        $videos = DB::table('videos')->paginate(5);
        return view('home');
        */
        /*Tambien lo puedo hacer utilizando el modelo, de esta forma debo de importar el modelo VIDEO en el controlador. Tambien utilizo el ORDER BY para ordenar los videos de mas nuevo a mas antiguo*/

        $videos = Video::orderBy('id','desc')-> paginate(5);
        /*Ahora le tengo que pasar la informacion a la vista, para eso le paso un array al VIEW*/

        return view ('videos',array(

            /*Creo un indice VIDEOS y le paso todos los videos, de esta forma ya tengo accesible todos los videos en la vista home*/
            'videos' =>$videos
        ));
    }
////////////   SHOW AUDIOS- /////////////////

    ////////////   SHOW VIDEOS- /////////////////
        public function audios()
    {
        //-------------PAGINATE----------------//
        /*Hay varias formas de hacerlo. Lo puedo hacer con el QUERY builder utilizando el metodo DB. En este caso NO tengo que importar el modelo de USER

        $audios = DB::table('audios')->paginate(5);
        return view('home');
        */
        /*Tambien lo puedo hacer utilizando el modelo, de esta forma debo de importar el modelo VIDEO en el controlador. Tambien utilizo el ORDER BY para ordenar los videos de mas nuevo a mas antiguo*/

        $audios = Audio::orderBy('id','desc')-> paginate(5);
        /*Ahora le tengo que pasar la informacion a la vista, para eso le paso un array al VIEW*/

        return view ('audios',array(

            /*Creo un indice VIDEOS y le paso todos los videos, de esta forma ya tengo accesible todos los videos en la vista home*/
            'audios' =>$audios
        ));
    }
////////////   SHOW DOCS /////////////////

       public function docs()
    {
        //-------------PAGINATE----------------//
        /*Hay varias formas de hacerlo. Lo puedo hacer con el QUERY builder utilizando el metodo DB. En este caso NO tengo que importar el modelo de USER
        
        $docs = DB::table('docs')->paginate(5);
        return view('mainView.documentos');
        */
        /*Tambien lo puedo hacer utilizando el modelo, de esta forma debo de importar el modelo VIDEO en el controlador. Tambien utilizo el ORDER BY para ordenar los videos de mas nuevo a mas antiguo*/
        
        $docs = Doc::orderBy('id','desc')-> paginate(5);
        /*Ahora le tengo que pasar la informacion a la vista, para eso le paso un array al VIEW*/

        return view ('docs',array(

            /*Creo un indice VIDEOS y le paso todos los videos, de esta forma ya tengo accesible todos los videos en la vista home*/

            'docs'=> $docs
        ));
    }
////////////   /SHOW DOCS /////////////////
}
