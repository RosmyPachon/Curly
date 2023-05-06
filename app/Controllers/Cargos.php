<?php

namespace App\Controllers;

use App\Controllers\BaseController; /*la plantilla del controlador general de codeigniter */
use App\Models\CargosModel;
class Cargos extends BaseController    
{    
    protected $cargos;
    public function __construct()
    {
        $this -> cargos = new CargosModel();
    }
        public function index() 
        {   
            $cargos= $this-> cargos->where('estado', "A")->findAll();        
            $data = ['titulo' => 'Curly Hair','nombre'=>'by Rosmy Pachon','cargos'=>$cargos]; // le asignamos a la variable data, que es la que interactua con la vista, los datos obtenidos del modelo, ademas de enviarle una variable titulo para el reporte.
            echo view('/principal/header' , $data);
            echo view('/cargos/cargos', $data);

            //echo view('/principal/principal',$data); //mostramos la vista desde el controlador y le enviamos la data necesaria, en este caso, estamos enviando el titulo
        }  

        public function eliminados()
        {
            $cargo = $this->cargos->where('estado','E')->findAll();
            $data = ['titulo' => 'CARGOS ELIMINADOS', 'titulo' => 'Curly Hair','nombre'=>'by Rosmy Pachon', 'datos' => $cargo];
    
            echo view('/principal/header', $data);
            echo view('/cargos/eliminados', $data);
      
        }

        public function buscar_Cargo($id)
    {
        $returnData = array();
        $cargo_ = $this->cargos->traer_Cargo($id);
        if (!empty($cargo_)) {
            array_push($returnData, $cargo_);
        }
        echo json_encode($returnData);
    } 
    public function insertar()
    {
        $tp=$this->request->getPost('tp');
        if ($this->request->getMethod() == "post") {
            if ($tp == 1) {
                $this->cargos->save([
                    'nombre' => $this->request->getPost('nombre')
                ]);
            } else {
                $this->cargos->update($this->request->getPost('id'),[                    
                    'nombre' => $this->request->getPost('nombre')
                ]);
            }
            return redirect()->to(base_url('/cargos'));
        }
    }

    public function eliminar($id,$estado){
        $cargo_ = $this->cargos->elimina_Cargo($id,$estado);
        return redirect()->to(base_url('/cargos'));
    }
        
        

}