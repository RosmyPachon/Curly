<?php

namespace App\Controllers;

use App\Controllers\BaseController; /*la plantilla del controlador general de codeigniter */
use App\Models\MunicipiosModel;
use App\Models\DepartamentosModel;
use App\Models\PaisesModel;
class Municipios extends BaseController    
{    
    protected $paises;
    protected $departamentos;
    protected $municipios;
    public function __construct()
    {
        $this -> paises = new PaisesModel();
        $this -> departamentos = new DepartamentosModel();
        $this -> municipios = new MunicipiosModel();
    }
        public function index() 
        {   
            $paises = $this->paises->where('estado', 'A')->findAll();         
            $departamentos = $this->departamentos->obtenerDepartamentos();         
            $municipios= $this-> municipios->obtenerMunicipios();
            $data = ['titulo' => 'Curly Hair','nombre'=>'by Rosmy Pachon','municipios'=>$municipios, 'departamentos' => $departamentos, 'paises' => $paises]; // le asignamos a la variable data, que es la que interactua con la vista, los datos obtenidos del modelo, ademas de enviarle una variable titulo para el reporte.
            echo view('/principal/header' , $data);
            echo view('/municipios/municipios', $data);

            //echo view('/principal/principal',$data); //mostramos la vista desde el controlador y le enviamos la data necesaria, en este caso, estamos enviando el titulo
        }    
        
        public function eliminados()
    {
        $paises = $this->paises->where('estado', 'A')->findAll(); 
        $departamentos = $this->departamentos->obtenerDepartamentos();         
        $municipios = $this-> municipios->eliminados_municipios();
        $data = ['titulo' => 'MUNICIPIOS ELIMINADOS', 'titulo' => 'Curly Hair','nombre'=>'by Rosmy Pachon', 'municipios' => $municipios, 'departamentos' => $departamentos, 'paises' => $paises];

        echo view('/principal/header', $data);
        echo view('municipios/eliminados', $data);
       
    }

    public function buscar_municipio($id)
    {
        $returnData = array();
        $municipio_ = $this->municipios->traer_municipios($id);
        if (!empty($municipio_)) {
            array_push($returnData, $municipio_);
        }
        echo json_encode($returnData);
    }

    public function insertar()
    {
        $tp=$this->request->getPost('tp');
        if ($this->request->getMethod() == "post") {
            if ($tp == 1) {
                $this->municipios->save([
                    'id_dpto' => $this->request->getPost('departamento'),
                    'nombre' => $this->request->getPost('nombre')
                ]);
            } else {
                $this->municipios->update($this->request->getPost('id'),[         
                    'id_dpto' => $this->request->getPost('departamento'),
                    'nombre' => $this->request->getPost('nombre')
                ]);

            }
            return redirect()->to(base_url('/municipios'));
        }
    }
        public function eliminar($id,$estado){
            $municipios_ = $this->municipios->elimina_municipio($id,$estado);
            return redirect()->to(base_url('/municipios'));
        }

        public function buscar_MunicipioDepartamento($id)
        {
            $returnData = array();
            $municipio = $this->municipios->traer_MunicipioDepartamento($id,'A');
            if (!empty($municipio)) {
                array_push($returnData, $municipio);
            }
            echo json_encode($returnData);
        }

        



        /*  */
        public function buscarDptoPaisPorIdMuni($idMuni) {
            $returnData = array();
            $municipio = $this->municipios->seleccionar_Municipio($idMuni, 'A');
            if (!empty($municipio)) {
                array_push($returnData, $municipio);
            }
            echo json_encode($returnData);
        }

}
