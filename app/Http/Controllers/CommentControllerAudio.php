<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//IMportamos el modelo de comentarios para poder interactuar con la base de datos
use App\CommentAudio;

class CommentControllerAudio extends Controller
{
    //Vamos a validar la informacion del formulario. Recojemos la informacion que nos llega por el post
    public function store(Request $request){
    	//Creamos variable para que recoja la inforamcion y le pasamos un array con las reglas de validacion
    	$validate = $this->validate($request, [
    		'body' => 'required'
    	]);
    	//Para poder utilizar los comentarios simplemente creamos un avariable comment y un NEW COMMENT para tener un objecto con el nuevo comentario que vamos a dar de alta
    	$comment= new CommentAudio();

    	//Creamos variable User para poder tener el usuario identificado
    	$user = \Auth::user();

    	//Le asigno un valor a la proipiedad de mi objeto. Utilizo el objeto USER y consigo su ID
    	$comment->user_id = $user->id;

    	//Ahora le voy a dar un valor a pa propiedad video ID que me viene por POST. Es el ID del video que recibo

    	//Tambien tengo que ver en cual audio guardo el comentario. Esto lo hago con el request y en el INPUT le pongo el ID del audio que me llega por POST
    	/*OJO con el audio_ID, me da problema para que guarde el audio con ID*/
    	$comment->audio_id = $request->input('audio_id');
    	$comment->body = $request->input('body');
    	//Finalmente guardo el comentario en la base de datos.
    	$comment-> save();

    	 return redirect()-> route('detailAudio',['audio_id'=> $comment->audio_id] )->with(array(
    	 		'message'=> 'Comentario añadido correctamente'
			));
    	 //Ahora tenemos que crea la ruta correspondiente
    }
    //-------------BORRAR-COMENTARIOS------------------
    // Este metodo va a recibir un parametro por la URL 
    public function delete($comment_id){
        //Cojemos el usuario identificado para comprobar si el usuario es el dueño del comentario.
        $user =\Auth::user();
        //Tengo que buscar el comentario para conseguir el objeto del comentario y de esta manera ya puedo eliminarlo
        $comment = CommentAudio::find($comment_id);
        //Comprobar si el comentario ha sido creado pro el mismo usuarios que esta identificado o es el dueño del audio.
        //Comprobar si el USER existe y si el ID del comentario es el mismo ID del usuario identificado podemos borrarlo.
        //OR si el dueño del audio esta tratando de borrar el comentario.
        //Tambien creamos un metodo en el modelo commentsAudio para poder acceder a la propiedad de audio
        if($user && ($comment->user_id == $user->id || $comment->audio->user_id == $user->id)){
            //En caso de que esto suceda puedo utilizar el metodo delete para borra un comentario. Borrar el objeto del ORM y por tanto de la BD.
            $comment->delete();
        }

        //Por ultimo hago un redirect que me lleve al video ID
        return redirect()-> route('detailAudio',['Audio_id'=> $comment->audio_id] )->with(array(
                'message'=> 'Comentario eliminado correctamente'
            ));
        //Ahora tengo que crear la ruta para este metodo.

    }
}
