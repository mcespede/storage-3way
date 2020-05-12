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

   		/******SI NO EXISTE EL USUARIO **************/
   		//Si el usuario no existe que me redirija al Home
   		if (!is_object($user)) {
   			return redirect()-> route('home');
   		}
   		//Vamos a sacar todos los videos asociados a ese usuario
   		//Sacame todos los videos cuyo user_id sea igual al user_id que me llega por la URL
   		$videos = Video::where('user_id',$user_id)->paginate(5);
   		//Finalmente devolvemos una vista con un array que contenga los datos del objeto de usuario y el objeto de video.
   		return view ('user.channel', array(
   			'user'=> $user,
   			'videos'=> $videos
   		));
   }

// *******************************************//
// ---------EDITAR Usuario --------//
//Recibo la variable ID del usuario por URL
public function edit($id){
     //Lo primero es conseguir una variable del usuario identificado
    $user = \Auth::user();
    //Creamos una variable userProfile para conseguri el objeto del ususario que estamos intentando editar. Utilizamos FIndOrFail para que nos devuelva un error en caso de que no exist aen la base de datos
    //Esta variable de userProfile es la que vamos a utilizar en el formulario para conseguir cada campo
    $userProfile = User::findOrFail($id);

    //Ahora tenenmos que comprobar si el usuario existe y el que solamente cuando estemos identificados como el ususario dueño del video podamos usarlo. SI otro lo intenta no va a poder
    /* 1- Si el usuario existe
       2-Si el ID que me llega por URL (userProfile) es igual al ID del usuario identificado
   */
    if($user && $userProfile->id == $user->id){

        //Devolvemos la vista edit dentro de la carpeta de user
        return view('user.edit-profile', array('userProfile' => $userProfile));

    //Si esto no funcionara hacemos una redireccion a la HOME sin mensaje
   //O si el usuario que intenta editar el perfil no es el que esta identificado
    }else{
        return redirect()->route('home');
    }
    //Ahora es necesario crear la vista de Edit
}
//*******************************************//
// ---------ACTUALIZAR VIDEO EN BD--------//
//Recibo la variable ID del usuario por URL, y tambien le paso la request para poder recibir los parametro que me lleguen por POST
public function update($id, Request $request){
     ///Lo primero que vamos a hacer es validar el formulario y le pasamos la request para que recoja todos los datos que llegan por POST. Ademas le vamos a pasar un array con las reglas de validacion.
    $validate = $this->validate($request, array(
            'name' =>'required ',
            'surname' =>'required',
            'alias' =>'required | min:5',
    ));

    //Ahora toca conseguir el objeto del usuario, con un FIND
    $userProfile = User::findOrFail($id);
    //Tambien vamos a conseguir el usuario identificado
    $user = \Auth::user();

    //Ahora le asigno los valores a cada una de las propuedades del objeto del usuario.
    $userProfile->id = $user->id;
    $userProfile->name = $request->input('name');
    $userProfile->surname = $request->input('surname');
    $userProfile->alias = $request->input('alias');

    //Ahora lo que tenemos que hacer es recojer los ficheros de imagen y video para guradarlos en la base de datos
    //Creo la variable image que me recoja el archivo que que me llega por la request , en este caso image
    
    $image = $request->file('image');
    // Entonces comprobamos si la imagen nos llega
    if ($image){
        //********OJO*************//
         //Antes de actualizar la imagen tenemos que eliminar el registro anterior para que La imagen no se reporduzca una y otra vez. Es decir si no elimino el registro cada vez que se actualize la imagen se crea una copia y nos satura la base de datos
         //Storage::disk('images')->delete($video->image);
         //*************************//
         //Si nos llega recojemos el path de la imagen
        //Obtenemos el nombre del fichero temporal
        //Le concateno time() para evitar tener el mismo archivo
        // $image_path = time().$image ->getClientOriginalName();
        //Ahora tenemos que utilizar el OBJETO storage y el metodo DISK para guardar todo dentro de la carpeta IMAGES el objeto $image que acabamos de conseguir
        // \Storage::disk('images')->put($image_path,\File::get($image));
        //Por ultimo asignamos al objeto IMAGE el valor del $image_path
         //$video->image = $image_path;
    //}

///Una vez que todo esto este listo ya podemos hacer un UPDARe en la base de datos.
    $userProfile->update();

    return redirect()->route('home')->with(array('message'=>'Tu perfile se ha actualizado correctamente'));
    //Finalmente ceramos la ruta.
}
}
