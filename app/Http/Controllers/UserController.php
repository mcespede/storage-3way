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
use App\Video;
use App\Comment;
//Para poder importar toda la info del usuario
use App\User;
class UserController extends Controller
{
   /*---------CANAL DE USUARIO ----------*/
   //Aqui vamos a capturar toda la informacion del usuario que nos llegue por un parametro de la URL
   public function channel($user_id){
   		// A traves del user_id (que llega por la URL) solicitamos al modelo USER toda la inforamcion del OBJETO del usuario 
   		$user = User::find($user_id);
   		//Vamos a sacar todos los videos asociados a ese usuario
   		//Sacame todos los videos cuyo user_id sea igual al user_id que me llega por la URL
   		$videos = Video::where('user_id',$user_id)->paginate(5);
   		//Finalmente devolvemos una vista con un array que contenga los datos del objeto de usuario y el objeto de video.
   		return view ('user.channel', array(
   			'user'=> $user,
   			'videos'=> $videos
   		));
   }
}
