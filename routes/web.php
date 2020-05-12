<?php
//Esto lo agrego para poder utilizar la entidad de VIDEO
//use App\Video;

Route::get('/', function () {

	/*----------------------------------------------*/
	/*------------PRUEBA DEL ORM ------------------*/
	/*----------------------------------------------*/
	/*
	// Creo una variable video y hago un FIND
	//Mediante el ORM saca todos los datos (VIDEO) que hay 
	$videos=Video::all();
	//Hago un FOR EACH para recorrer todos los datos que hay en la base de datos e ir sacando datos de cada uno
	foreach ($videos as $video) {
		//Dentro de cada interaccion defino los datos que deseo ver.
		echo $video -> title.'<br/>';
		echo $video -> user ->name.'<br/>';
		echo $video -> user ->email.'<br/>';
		//Ahora para ver la informacion detallada de cada uno de los comentario  en cada video hago otro for each
		foreach ($video->comments as $comment) {
			echo $comment-> body.'<br/>';
		}
		//Esto lo hago para poder verlo de forma separada
		echo "<hr/";
		//var_dump($video);
	}
	*/
	/*----------------------------------------------*/
	/*------------/PRUEBA DEL ORM ------------------*/
	/*----------------------------------------------*/
    return view('welcome');
});

// Esto es un middleware que verifica la Autenticacion del usuario
Auth::routes();

//Esta ruta la vamos a utilizar para no se necesite authenticacion para ver los videos, pero si para modificarlos
//En el homecontroller le quitamos la parte de la atenticacion y le ponemos el middleware web
Route::get('/home', array(
	'as'=> 'home',
	'uses'=> 'HomeController@index'
));

//------------RUTAS CONTROLADOR VIDEOS -------------

/*------------CREAR------------------*/
/*Creamos la ruta hacia la pagina y utilizamos un array para pasarle los parametros que estaremos utilizando*/
Route::get ('/crear-video', array(
	//Este va a ser el nombre de la ruta
	'as' => 'createVideo', 
	//Uso el AUTH para que solo pueda crear videos si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'VideoController@createVideo'
));

/*------------GUARDAR------------------*/
/*Creamos la ruta para guardar el video una vez creado*/
Route::post ('/guardar-video', array(
	//Este va a ser el nombre de la ruta
	'as' => 'saveVideo', 
	//Uso el AUTH para que solo pueda crear videos si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'VideoController@saveVideo'
));
/*------------GET-IMAGE------------------*/
//A la ruta le tengo que pasar el parametro que llega obligatoriamente. 
Route::get('/miniatura/{filename}', array(
//Como segundo parametro le paso un array con el nombre que va a tenr la ruta
	'as' => 'imageVideo',
//Que controlador va a utilizar y que metodo dentro de ese controlador
	'uses' =>'VideoController@getImage'
));

/*------------PAGINA -VIDEO-----------------*/
/* Le pasamos por URL el parametro obligatorio del video y un array con las caracteristicas del video*/
Route::get('/video/{video_id}',array(
	'as'=> 'detailVideo',
	'uses'=> 'VideoController@getVideoDetail'
));

/*------------GET-VIDEO------------------*/
//A la ruta le tengo que pasar el parametro que llega obligatoriamente. 
Route::get('/video-file/{filename}', array(
//Como segundo parametro le paso un array con el nombre que va a tenr la ruta
	'as' => 'fileVideo',
//Que controlador va a utilizar y que metodo dentro de ese controlador
	'uses' =>'VideoController@getVideo'
));

/*------------ADD-COMMENT------------------*/
//Indicamos el nombre de la ruta y metodo que va a cargar
Route::post('/comment',array(
	'as'=> 'comment',
	'middleware'=>'auth',
	'uses'=> 'CommentController@store'
));

/*------------DELETE-COMMENT------------------*/
//Indicamos el nombre de la ruta y metodo que va a cargar
//---OJO---Si no le pasamos el segundo parametro me da error NotFoundHttpException
//Esto porque es el parametro que le estamos pasando por el metodo del controlador. MUST BE HERE ALSO
Route::get('/delete-comment/{comment_id}',array(
	'as'=> 'commentDelete',
	'middleware'=>'auth',
	'uses'=> 'CommentController@delete'
));

/*------------DELETE-VIDEO------------------*/
//Indicamos el nombre de la ruta y metodo que va a cargar
//---OJO---Si no le pasamos el segundo parametro me da error NotFoundHttpException
//Esto porque es el parametro que le estamos pasando por el metodo del controlador. MUST BE HERE ALSO
Route::get('/delete-video/{video_id}',array(
	'as'=> 'videoDelete',
	'middleware'=>'auth',
	'uses'=> 'VideoController@delete'
));

/*------------EDITAR VIDEO------------------*/
/*Creamos la ruta para editar el video y le pasamos el parametro de video_id*/
Route::get('/editar-video/{video_id}', array(
	//Este va a ser el nombre de la ruta
	'as' => 'editVideo', 
	//Uso el AUTH para que solo pueda crear videos si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'VideoController@edit'
));
/*------------GUARDAR-UPDATE------------------*/
/*Creamos la ruta para guardar el video una vez creado*/
Route::post ('/update-video/{video_id}', array(
	//Este va a ser el nombre de la ruta
	'as' => 'updateVideo', 
	//Uso el AUTH para que solo pueda crear videos si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'VideoController@update'
));
/*------------SEARCH------------------*/
//El parametro search es un parametro opcional, me puede venir o no
//Para que el FILTRO funcione le tengo que pasar a la ruta otro parametro FILTER. Tambien va a ser opcional (?)
Route::get('/buscar/{search?}/{filter?}',array(
	'as'=>'videoSearch',
	'uses'=> 'VideoController@search'
));

/*------------BORRAR-CACHE------------------*/
/* Esta ruta nos permite borra el cache de Laravel
	Es exactamente igual que ejecutarlo en la consola*/

Route::get('/clear-cache',function(){
	$code = Artisan::call('cache:clear');
});

/*------------CANAL-USUARIO------------------*/
//El user_id es obligatorio
Route::get('/canal/{user_id}',array(
	'as'=> 'channel',
	'uses'=> 'UserController@channel'
));

/////********CONTACTO***********////
Route::get('/contacto', function () {
	    return view('contacto');
});