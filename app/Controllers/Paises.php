<?php

namespace App\Controllers;

use App\Controllers\BaseController; /*la plantilla del controlador general de codeigniter */
use App\Models\PaisesModel;
class Paises extends BaseController    
{    
    protected $paises;
    public function __construct()
    {
        $this -> paises = new PaisesModel();
    }
        public function index() 
        {   
            $paises= $this-> paises->where('estado', "A")->findAll();         
            $data = ['titulo' => 'Curly Hair','nombre'=>'by Rosmy Pachon','paises'=>$paises]; // le asignamos a la variable data, que es la que interactua con la vista, los datos obtenidos del modelo, ademas de enviarle una variable titulo para el reporte.
            echo view('/principal/header' , $data);
            echo view('/paises/paises', $data);
            //echo view('/principal/principal',$data); //mostramos la vista desde el controlador y le enviamos la data necesaria, en este caso, estamos enviando el titulo
        } 
        
        public function eliminados()
    {
        $pais = $this->paises->where('estado','E')->findAll();
        $data = ['titulo' => 'PAISES ELIMINADOS', 'titulo' => 'Curly Hair','nombre'=>'by Rosmy Pachon', 'datos' => $pais];

        echo view('/principal/header', $data);
        echo view('paises/eliminados', $data);
       
    }

        public function buscar_Pais($id)
    {
        $returnData = array();
        $pais_ = $this->paises->traer_Pais($id);
        if (!empty($pais_)) {
            array_push($returnData, $pais_);
        }
        echo json_encode($returnData);
    }
    public function insertar()
    {
        $tp=$this->request->getPost('tp');
        if ($this->request->getMethod() == "post") {
            if ($tp == 1) {
                $this->paises->save([
                    'codigo' => $this->request->getPost('codigo'),
                    'nombre' => $this->request->getPost('nombre')
                ]);
            } else {
                $this->paises->update($this->request->getPost('id'),[                    
                    'codigo' => $this->request->getPost('codigo'),
                    'nombre' => $this->request->getPost('nombre')
                ]);
            }
            return redirect()->to(base_url('/paises'));
        }
    }
    public function eliminar($id,$estado){
        $pais_ = $this->paises->elimina_Pais($id,$estado);
        return redirect()->to(base_url('/paises'));
    }
}
