<?php
//Esto lo agrego para poder utilizar la entidad de VIDEO
//use App\Video;
use App\User;

//----------------------------------------------------------------------------------------
//------------------RUTAS CONTROLADOR (/) ---------------------------------------------
//----------------------------------------------------------------------------------------
/*Para que sedespliegue la vista de todos las opciones del menu
  del Landing page tenenmos que crear el controlador Landingpage
  ahi van a estar los metodos que nos permiten acceder a las listas
  y  a toda la informacion 
  Cada ruta debe de tener un metodo detras*/

Route::get('/', function () {
    return view('welcome');
});

//--------LISTA DE VIDEOS------------//
Route::get('/videos', array(
	'as'=> 'videos',
	'uses'=> 'LandingPage@videos'
));
//--------LISTA DE AUDIOS------------//
Route::get('/audios', array(
	'as'=> 'audios',
	'uses'=> 'LandingPage@audios'
));
//--------LISTA DE DOCS------------//
Route::get('/documentos', array(
	'as'=> 'docs',
	'uses'=> 'LandingPage@docs'
));

Route::get('/robotica', function () {
    return view('mainView.robotica');
});

Route::get('/sistemas', function () {
    return view('mainView.sistemas');
});

Route::get('/sobre-mi', function () {
    return view('mainView.sobreMi');
});


Route::get('/desarrolloWeb', function () {
    return view('mainView.desarrolloWeb');
});
//----------------------------------------------------------------------------------------
//------------------AUTHENTICATION ---------------------------------------------
//----------------------------------------------------------------------------------------

// Esto es un middleware que verifica la Autenticacion del usuario
//Solo usuarios identificados pueden crear nuevos usuarios
Auth::routes();
//----------------------------------------------------------------------------------------
//------------------RUTAS CONTROLADOR HOME ---------------------------------------------
//----------------------------------------------------------------------------------------

//Esta ruta la vamos a utilizar para no se necesite authenticacion para ver los videos, pero si para modificarlos
//En el homecontroller le quitamos la parte de la atenticacion y le ponemos el middleware web
Route::get('/home', array(
	'as'=> 'home',
	'uses'=> 'HomeController@index'
));
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//------------------RUTAS CONTROLADOR VIDEOS ---------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
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
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//------------------/RUTAS CONTROLADOR VIDEOS ---------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------

/*------------BORRAR-CACHE------------------*/
/* Esta ruta nos permite borra el cache de Laravel
	Es exactamente igual que ejecutarlo en la consola*/

Route::get('/clear-cache',function(){
	$code = Artisan::call('cache:clear');
});
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//------------------/RUTAS CONTROLADOR USERS ---------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------

/*------------CANAL-USUARIO------------------*/
//El user_id es obligatorio
Route::get('/canal/{user_id}',array(
	'as'=> 'channel',
	'uses'=> 'UserController@channel'
));

/*------------EDITAR PERFIL------------------*/
/*Creamos la ruta para editar el perfil del usuario  y le pasamos el parametro de user_id*/
Route::get('/editar-perfil/{id}', array(
	//Este va a ser el nombre de la ruta
	'as' => 'editProfile', 
	//Uso el AUTH para que solo pueda crear videos si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'UserController@edit'
));

/*------------GET-IMAGE------------------*/
//A la ruta le tengo que pasar el parametro que llega obligatoriamente. 
Route::get('/avatar/{filename}', array(
//Como segundo parametro le paso un array con el nombre que va a tenr la ruta
	'as' => 'imageProfile',
//Que controlador va a utilizar y que metodo dentro de ese controlador
	'uses' =>'UserController@getImage'
));

/*------------GUARDAR-UPDATE------------------*/
/*Creamos la ruta para guardar el video una vez creado*/
Route::post ('/update-user/{id}', array(
	//Este va a ser el nombre de la ruta
	'as' => 'updateUser', 
	//Uso el AUTH para que solo pueda crear videos si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'UserController@update'
));


/*------------MOSTRAR Usuarios------------------*/
/*Creamos la ruta para editar el perfil del usuario  y le pasamos el parametro de user_id*/
Route::get('/users', array(
	//Este va a ser el nombre de la ruta
	'as' => 'showUsers', 
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'UserController@showUsers'
));

//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//------------------/RUTAS CONTROLADOR USERS ---------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------

/////********CONTACTO***********////
Route::get('/contacto', function () {
	    return view('contacto');
});


//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//------------------RUTAS CONTROLADOR AUDIOS ---------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------

/*------------CREAR------------------*/
/*Creamos la ruta hacia la pagina y utilizamos un array para pasarle los parametros que estaremos utilizando*/
Route::get ('/crear-audio', array(
	//Este va a ser el nombre de la ruta
	'as' => 'createAudio', 
	//Uso el AUTH para que solo pueda crear audios si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'AudioController@createAudio'
));

/*------------GUARDAR------------------*/
/*Creamos la ruta para guardar el audio una vez creado*/
Route::post ('/guardar-audio', array(
	//Este va a ser el nombre de la ruta
	'as' => 'saveAudio', 
	//Uso el AUTH para que solo pueda crear audios si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'AudioController@saveAudio'
));

/*------------PAGINA -AUDIO-----------------*/
/* Le pasamos por URL el parametro obligatorio del audio y un array con las caracteristicas del audio*/
Route::get('/audio/{audio_id}',array(
	'as'=> 'detailAudio',
	'uses'=> 'AudioController@getAudioDetail'
));

/*------------GET-AUDIO------------------*/
//A la ruta le tengo que pasar el parametro que llega obligatoriamente. 
Route::get('/audio-file/{filename}', array(
//Como segundo parametro le paso un array con el nombre que va a tenr la ruta
	'as' => 'fileAudio',
//Que controlador va a utilizar y que metodo dentro de ese controlador
	'uses' =>'AudioController@getAudio'
));

/*------------ADD-COMMENT------------------*/
//Indicamos el nombre de la ruta y metodo que va a cargar
Route::post('/comment-audio',array(
	'as'=> 'commentAudio',
	'middleware'=>'auth',
	'uses'=> 'CommentControllerAudio@store'
));

/*------------DELETE-COMMENT------------------*/
//Indicamos el nombre de la ruta y metodo que va a cargar
//---OJO---Si no le pasamos el segundo parametro me da error NotFoundHttpException
//Esto porque es el parametro que le estamos pasando por el metodo del controlador. MUST BE HERE ALSO
Route::get('/delete-comment-audio/{comment_id}',array(
	'as'=> 'commentDelete',
	'middleware'=>'auth',
	'uses'=> 'CommentControllerAudio@delete'
));

/*------------DELETE-Audio------------------*/
//Indicamos el nombre de la ruta y metodo que va a cargar
//---OJO---Si no le pasamos el segundo parametro me da error NotFoundHttpException
//Esto porque es el parametro que le estamos pasando por el metodo del controlador. MUST BE HERE ALSO
Route::get('/delete-audio/{audio_id}',array(
	'as'=> 'audioDelete',
	'middleware'=>'auth',
	'uses'=> 'AudioController@delete'
));

/*------------EDITAR AUDIO------------------*/
/*Creamos la ruta para editar el audio y le pasamos el parametro de audio_id*/
Route::get('/editar-audio/{audio_id}', array(
	//Este va a ser el nombre de la ruta
	'as' => 'editAudio', 
	//Uso el AUTH para que solo pueda crear audios si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'AudioController@edit'
));
/*------------GUARDAR-UPDATE------------------*/
/*Creamos la ruta para guardar el audio una vez creado*/
Route::post ('/update-audio/{audio_id}', array(
	//Este va a ser el nombre de la ruta
	'as' => 'updateAudio', 
	//Uso el AUTH para que solo pueda crear audios si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'AudioController@update'
));
/*------------SEARCH------------------*/
//El parametro search es un parametro opcional, me puede venir o no
//Para que el FILTRO funcione le tengo que pasar a la ruta otro parametro FILTER. Tambien va a ser opcional (?)
Route::get('/buscar-audio/{search?}/{filter?}',array(
	'as'=>'audioSearch',
	'uses'=> 'AudioController@search'
));
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//------------------/RUTAS CONTROLADOR AUDIO ---------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------


//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//------------------RUTAS CONTROLADOR DOCS ---------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------

/*------------CREAR------------------*/
/*Creamos la ruta hacia la pagina y utilizamos un array para pasarle los parametros que estaremos utilizando*/
Route::get ('/crear-doc', array(
	//Este va a ser el nombre de la ruta
	'as' => 'createDoc', 
	//Uso el AUTH para que solo pueda crear docs si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'DocController@createDoc'
));

/*------------GUARDAR------------------*/
/*Creamos la ruta para guardar el doc una vez creado*/
Route::post ('/guardar-doc', array(
	//Este va a ser el nombre de la ruta
	'as' => 'saveDoc', 
	//Uso el AUTH para que solo pueda crear docs si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'DocController@saveDoc'
));

/*------------PAGINA-DOC-----------------*/
/* Le pasamos por URL el parametro obligatorio del doc y un array con las caracteristicas del doc*/
Route::get('/doc/{doc_id}',array(
	'as'=> 'detailDoc',
	'uses'=> 'DocController@getDocDetail'
));

/*------------GET-DOC------------------*/
//A la ruta le tengo que pasar el parametro que llega obligatoriamente. 
Route::get('/doc-file/{filename}', array(
//Como segundo parametro le paso un array con el nombre que va a tenr la ruta
	'as' => 'fileDoc',
//Que controlador va a utilizar y que metodo dentro de ese controlador
	'uses' =>'DocController@getDoc'
));



/*------------ADD-COMMENT------------------*/
//Indicamos el nombre de la ruta y metodo que va a cargar
Route::post('/comment-doc',array(
	'as'=> 'commentDoc',
	'middleware'=>'auth',
	'uses'=> 'CommentControllerDoc@store'
));

/*------------DELETE-COMMENT------------------*/
//Indicamos el nombre de la ruta y metodo que va a cargar
//---OJO---Si no le pasamos el segundo parametro me da error NotFoundHttpException
//Esto porque es el parametro que le estamos pasando por el metodo del controlador. MUST BE HERE ALSO
Route::get('/delete-comment-doc/{comment_id}',array(
	'as'=> 'commentDelete',
	'middleware'=>'auth',
	'uses'=> 'CommentControllerDoc@delete'
));

/*------------DELETE-DOC------------------*/
//Indicamos el nombre de la ruta y metodo que va a cargar
//---OJO---Si no le pasamos el segundo parametro me da error NotFoundHttpException
//Esto porque es el parametro que le estamos pasando por el metodo del controlador. MUST BE HERE ALSO
Route::get('/delete-doc/{doc_id}',array(
	'as'=> 'docDelete',
	'middleware'=>'auth',
	'uses'=> 'DocController@delete'
));

/*------------EDITAR DOC------------------*/
/*Creamos la ruta para editar el doc y le pasamos el parametro de doc_id*/
Route::get('/editar-doc/{doc_id}', array(
	//Este va a ser el nombre de la ruta
	'as' => 'editDoc', 
	//Uso el AUTH para que solo pueda crear docs si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'DocController@edit'
));
/*------------GUARDAR-UPDATE------------------*/
/*Creamos la ruta para guardar el doc una vez creado*/
Route::post ('/update-doc/{doc_id}', array(
	//Este va a ser el nombre de la ruta
	'as' => 'updateDoc', 
	//Uso el AUTH para que solo pueda crear docs si estoy identificados
	'middleware'=> 'auth',
	//Ahora le indico que clase y que controlador(accion) va a utilizar
	'uses' => 'DocController@update'
));
/*------------SEARCH------------------*/
//El parametro search es un parametro opcional, me puede venir o no
//Para que el FILTRO funcione le tengo que pasar a la ruta otro parametro FILTER. Tambien va a ser opcional (?)
Route::get('/buscar-doc/{search?}/{filter?}',array(
	'as'=>'docSearch',
	'uses'=> 'DocController@search'
));
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//------------------/RUTAS CONTROLADOR DOCS ---------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
