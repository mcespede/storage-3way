<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Todas las request que nos llegan por HTT
use App\Http\Requests;
//Todo el tema de la bases de datos
use Illuminate\Support\Facades\DB;
//Para poder almacenar en el Storage
use Illuminate\Support\Facades\Storage;

use Symfony\Component\HttpFoundation\Response;

//Ahora importo los modelos
use App\User;
use App\Audio;
use App\CommentAudio;


class AudioController extends Controller
{


//*******************************************//
    //-------------CREAR UN AUDIO------------------
    //Simplemente una pagina que nos muetre los Audios

    public function createAudio(){
    	return view('audio.createAudio');
    }


//*******************************************//
    //-------------GUARDAR UN Audio------------------
    //Validar formulario
    //Le pasamos como primero parametro los datos que llegan por POST
    public function saveAudio (Request $request){
    	//Creamos una variable que se llama ValidateData
    	//Le pasamos en un array las reglas de validacion
    	$validateData = $this->validate($request, [
    		'title' =>'required | min:5',
    		'description'=> 'required',
    		//Los formatos en los que puede venir el audio
    		'audio' => 'mimetypes:audio/mpeg,mp4,ogg'

    	]);
    	//Ahora vamos a guardar el audio en la base de datos
    	//Utilizamos la entidad de AUDIO y creamos un objeto nuevo
    	$audio = new Audio();
    	//Ahora creo una variable USER para guardar la informacion del usuario identificado
    	$user = \Auth::user();
    	// Ahora al audio le asigno un valor a cada una de las propiedades, con las variables que me llegan por POST
    	$audio ->user_id = $user->id;
    	$audio ->title = $request->input('title');
    	$audio ->description = $request ->input('description');
    	//Ahora para guardar el nuevo objeto en la BD en la base de datos utilizo metodo SAVE()

    	// -----  UPLOAD AUDIO ----//
    	$audio_file = $request->file('audio');

    	if($audio_file){

    		$audio_path = time().$audio_file ->getClientOriginalName();
    		\Storage::disk('audios')->put($audio_path,\File::get($audio_file));

    		$audio->audio_path = $audio_path;

    	}

    	$audio ->save();

    	//Cuando termino le hago una redireccion a HOME
    	//Ademas añado una alerta que diga que el audio se ha subido correctamente
    	return redirect()->route ('home')->with(array(
    		'message'=> 'El audio se ha subido correctamente'
    	 ));
    //*********CARPETA STORAGE ******************//
    //Para que esto funcione correctamente necesito configurar los Drivers del Storage. Para ello CONFIG>fileSystems.php 
    //*********************************************//
    }

//*******************************************//
    // ----PAGINA DETALLE DEL AUDIO------//
    // TEnemos que pasar el $audio_ID que el el detalle del audio que deseamos mostrar

    public function getAudioDetail ($audio_id){
        //Creamos una variable audio que haga un FIND a la BD para conseguir el registro que deseamos mostrar. Esto lo podemos hacer con ELOQUENT y el metodo find- Le solicitamos el audio_id. Diferente como se hace con el QUERY builder
        $audio = Audio::find($audio_id);
        //Cargamos una vista que se llma audio y un array con la infomracion del audio a cargar
        return view('audio.detailAudio', array(
            //Audio va a llevar dentro todo el contenido de la variable $audio
            'audio' =>$audio
        //POr ultimo es necesario crear la vista para este metodo
        ));

    }

// *******************************************//
    // ---------MOSTRAR AUDIO --------//
    /* Este metodo recibo por URL el nombre del fichero*/
    public function getAudio($filename){
        $file = Storage::disk('audios')->get($filename);
        return new Response($file,200);
    }


// *******************************************//
    // ---------ELIMINAR Audio --------//
    /* Este metodo recibo por URL el nombre del fichero*/
    public function delete($audio_id){
        //Lo primero es conseguir una variable del usuario identificado
        $user = \Auth::user();
        //Ahora hacemos un find para conseguir el audio que deseamos borrar
        $audio = Audio::find($audio_id);
        //Tambien hacemos un find de los comentarios que deseamos borrar. Asegurarse de tener importado el modelo de commentAudio
        //Esto nos va a sacar todos los comentarios cuyo audio_id sea el correspondiente
        $comments = CommentAudio::where('audio_id',$audio_id)->get();
        $comments = CommentAudio::where('audio_id',$audio_id);
        //Ahora tenenmos que comprobar si el usuario existe y el que solamente cuando estemos identificados como el ususario dueño del audio podamos usarlo. SI otro lo intenta no va a poder
        if($user && $audio->user_id == $user->id){
            //Antes de borrar el audio tenemos que borar los comentarios
            //Method delete does not exist----Para evitar este error hacemos un IF antes de borra comentarios para asegurarnos de que existan comentarios. Lo hacemos con un IF

            /*******Warning: count(): Parameter must be an array or an object that implements Countable***/
            //if($comments && count($comments)>=1) esto no provoca el error. EL is_array lo soluciona
            if(is_array($comments) && count($comments)>=1){
                foreach ($comments as $comment) {
                     $comments->delete();                 
                }            
            }
            //Despues tenemos que eliminar los audios a nivel de disco fisico. Eliminarlos del Storage. Utilizamos el OBJETO  audio y la PROPIEDAD audio_path.
            Storage::disk('audios')->delete($audio->audio_path);
            //Finamente eliminar el registro del audio en la base de datos
            $audio->delete();
        }
        //Lo ultimo que hace este metodo es redirigirnos a HOME con el aaray de mensaje para que me diga si se elimino o no correctamente
        return redirect()->route('home')->with(array(
            'message'=>'Audio eliminado correctamente'
        ));
    }

// *******************************************//
// ---------EDITAR AUDIO --------//
//Recibo la variable ID del audio por URL
public function edit($audio_id){
     //Lo primero es conseguir una variable del usuario identificado
    $user = \Auth::user();
    //Creamos una variable audio para conseguir el objeto del audio que estamos intentando editar. Utilizamos FindOrFail para que nos devuelva un error en caso de que no exista en la base de datos
    $audio = Audio::findOrFail($audio_id);

    //Ahora tenemos que comprobar si el usuario existe y el que solamente cuando estemos identificados como el usuario dueño del audio podamos usarlo. SI otro lo intenta no va a poder
    if($user && $audio->user_id == $user->id){
        //Devolvemos la vista edit dentro de la carpeta de audios
        return view('audio.editAudio', array('audio' => $audio));
    //Si esto no funcionara hacemos una redireccion a la HOME sin mensaje
    }else{
        return redirect()->route('home');
    }
    //Ahora es necesario crear la vista de Edit
}
//*******************************************//
// ---------ACTUALIZAR AUDIO EN BD--------//
//Recibo la variable ID del audio por URL, y tambien le paso la request para poder recibir los parametro que me lleguen por POST
public function update($audio_id, Request $request){
     ///Lo primero que vamos a hacer es validar el forrmulario y le pasamos la request para que recoja todos los datos que llegan por POST. Ademas le vamos a pasar un array con las reglas de validacion.
    $validate = $this->validate($request, array(
            'title' =>'required | min:5',
            'description'=> 'required',
            //Los formatos en los que puede venir el audio
            'audio' => 'mimetypes:audio/mp3,mp4,ogg'
    ));

    //Ahora toca conseguir el objeto del audio, con un FIND
    $audio = Audio::findOrFail($audio_id);
    //Tambien vamos a conseguir el usuario identificado
    $user = \Auth::user();
    //Ahora le asigno los valores a cada una de las propuedades del objeto del audio.
    $audio->user_id = $user->id;
    $audio->title = $request->input('title');
    $audio->description = $request->input('description');

    //Ahora lo que tenemos que hacer es recojer los ficheros del audio para guradarlos en la base de datos
    //Creo la variable audio que me recoja el archivo que que me llega por la request , en este caso image

    // -----  UPLOAD AUDIO ----//
    $audio_file = $request->file('audio');

    if($audio_file){
        //********OJO*************//
        //Antes de actualizar el audio tenemos que eliminar el registro anterior para que el audio no se reporduzca una y otra vez. Es decir si no elimino el registro cada vez que se actualize el audio se crea una copia y nos satura la base de dato.
        Storage::disk('audio')->delete($audio->audio_path);
        //*************************//

        ///Una vez borrado el registro ya se puede actualizar.
         $audio_path = time().$audio_file ->getClientOriginalName();
        \Storage::disk('audios')->put($audio_path,\File::get($audio_file));

        $audio->audio_path = $audio_path;
    }


///Una vez que todo esto este listo ya podemos hacer un UPDARe en la base de datos.
    $audio->update();

    return redirect()->route('home')->with(array('message'=>'EL audio se ha actualizado correctamente'));
    //Finalmente ceramos la ruta.
}
//*******************************************//
// ---------FUNCION DE SEARCH--------//

//Le pasamos por parametro la busqueda que vamos a realizar
//POr defecto el parametro va a ser NULL porque puede que el parametro venga por la URL con busqueda o sin busqueda
//Tambien pasamos el parametro filter para poder utilizarlo
public function search($search = null, $filter = null){

    //Si el parametro de SEARCH es nulo entonces le vamos a asignar un valor a search que es que que vienen en la request
    if (is_null($search)) {
        //De esta forma siempre va a tener un valor que es el que ingresa en la barra de busqueda.
        //Esta es la variable que nos llega por get
        $search= \Request::get('search');

        /**************SI PRESIONO EL BOTON SIN NINGUNA BUSQUEDA*************/
        //Si presiono el boton de busqueda sin nada nos redirige al listado principal en el HOME
        if (is_null($search)) {
           return redirect()->route('mainPage');
        }
        /*******************************************************************/
        //Esto es para que nos llegue un parametro limpia cuando nos redirija
        //De esta manera a la hora de buscar algo, la direccion sale con lo que escribi en search
        //Le pasamos el contenido que tiene la variable por GET
        return redirect()->route('audioSearch',array('search' =>$search));
    }

    //-----FILTRO--------
    /*Si no existe el parametro FILTER es decir es NULO,
     *Si existe el parametro que me llega por GET
     *Pero no es nulo SEARCH, entonces ...
      me hace una redireccion con el filtro capturando el parametro GET sino nada*/
    if (is_null($filter) && \Request::get('filter') && !is_null($search)) {
        //Creamos variable filter para capturar el parametro por GET
        $filter= \Request::get('filter');
        //Esto es para que nos llegue un parametro limpia cuando nos redirija
        //De esta manera a la hora de buscar algo, la direccion sale con lo que escribi en search
        //Le pasamos el contenido que tiene la variable por GET, es decir los dos parametros
        return redirect()->route('audioSearch',array('search' =>$search, 'filter' =>$filter));
    }
    /**************Si hay filtro***********/
    //Aqui vamos a optimizar la consulta para que queda perfecta
    //Creamos dos variable que son las que va a utilizar el ORDERBY
    //Estas con las variables que cambian en el filtro cunado seleccionamos las opciones
    $colum ='id';
    $order = 'desc';
    //En caso de que el filtro exista, es decir que no es NULL
    if (!is_null($filter)) {
        //Hacemos el ordenamiento de los audio de acuerdo a los criterios del filtro
        //Ahora tenemos que hacer un acomprobarcion con el IF
        if ($filter == 'new') {
            $colum ='id';
            $order = 'desc';;
        }
        if ($filter == 'old') {
            $colum ='id';
            $order = 'asc';;
        }
        if ($filter == 'alfa') {                                
            $colum ='title';
            $order = 'asc';;
        }

    }
    /***************************************/
    //Vamos a hacer una QUERY , para que busque en el titulo la informacion
    //Cuando realicemos la busqueda, si el titulo es igual a lo que venga en SEARCH que nos de el resultado
    //Sacame todos los audio cuando el titulo contenga lo que hemos buscado
    //Los % los pongo para que me saque la coincidencias de la Primera letra y la Ultima, no solo el resultado completo
    
    $audios = Audio::where('title','LIKE','%'.$search.'%')
                            //Ha esto le agregamos el ORDERBY con los valores de las variables de arriba y el paginate
                            ->orderBy($colum,$order)
                            ->paginate(5);

    return view('audio.searchAudio', array(
        'audios'=> $audios,
        'search'=> $search
    ));
}

}
