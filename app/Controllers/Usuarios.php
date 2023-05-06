<?php

namespace App\Controllers;

use App\Controllers\BaseController; /*la plantilla del controlador general de codeigniter */
use App\Models\UsuariosModel;
class Usuarios extends BaseController    
{    
    protected $usuarios;
    public function __construct()
    {
        $this -> usuarios = new UsuariosModel();
    }
        public function index() 
        {   
            $usuarios= $this-> usuarios->where('estado', "A")->findAll();         
            $data = ['titulo' => 'Curly Hair','nombre'=>'by Rosmy Pachon','usuarios'=>$usuarios]; // le asignamos a la variable data, que es la que interactua con la vista, los datos obtenidos del modelo, ademas de enviarle una variable titulo para el reporte.
            echo view('/principal/header' , $data);
            echo view('/usuarios/usuarios', $data);
            //echo view('/principal/principal',$data); //mostramos la vista desde el controlador y le enviamos la data necesaria, en este caso, estamos enviando el titulo
        } 
        
}
