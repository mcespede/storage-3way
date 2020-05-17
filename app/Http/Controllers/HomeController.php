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
        $this->middleware('auth');
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
        return view ('home',array(
        ));
    }

}
