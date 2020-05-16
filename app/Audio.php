<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
   //Lo primero es indicar a que tabla o entidad hace referencia el modelo

    protected $table = 'audios';

    //Ahora defino la relacion con las diferentes entidades

    //RELACION ONE TO MANY
    //En decir que dentro de un audio pueden hacer muchos comentarios. Cuando consigamos un objeto de tipo AUDIO tengamos una propiedad que contenga todos los comentarios relacionados con ese AUDIO.

    public function comments(){
   		// Esto me crea la propiedad COMMENTS y me saca toda la informacion que este relacionada con el audio. Es decir nos carga destro de una propiedad coments todos los datos asociados al Audio. Nos evita tener que escribir un monton de codigo para sacar informacion de audio. Es un camino mucho mas facil que nos ofrece ELOQUENT y LARAVEL
        //Le hago un ORDERBY para que los comentarios me aparescan del mas nuevo al mas antiguo
    	return $this -> hasMany('App\CommentAudio')->orderBy('id','desc');
    }
    //RELACION MANY TO ONE
    // Me saca el objeto del usuario . EL objeto completo del usuario que ha creado el audio
    public function user(){
    	//En este caso necesito definir en que campo se va a relacionar, que fue lo que hicimos al crear las Foreing keys en la table.
    	//Es decir que dentro de la propiedad USER va a cargar todo el objeto del usuario que se identifique con el user_id.
		return $this -> belongsTo('App\User','user_id');   
    }


}