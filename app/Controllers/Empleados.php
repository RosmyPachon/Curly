<?php

namespace App\Controllers;

use App\Controllers\BaseController; /*la plantilla del controlador general de codeigniter */
use App\Models\EmpleadosModel;
use App\Models\PaisesModel;
use App\Models\DepartamentosModel;
use App\Models\MunicipiosModel;
use App\Models\CargosModel;

class Empleados extends BaseController    
{    
    protected $empleados;
    protected $paises;
    protected $departamentos;
    protected $municipios;
    protected $cargos;
    public function __construct()
    {
        $this -> empleados = new empleadosModel();
        $this -> paises = new PaisesModel();
        $this -> departamentos = new DepartamentosModel();
        $this -> municipios = new MunicipiosModel();
        $this -> cargos = new CargosModel();
    }
        public function index() 
        {   
            $paises = $this->paises->where('estado', 'A')->findAll();         
            $departamentos = $this->departamentos->obtenerDepartamentos();         
            $municipios= $this-> municipios->obtenerMunicipios();
            $empleados= $this-> empleados->obtenerEmpleados();         
           $cargos= $this-> cargos->where('estado', "A")->findAll();         
            $data = ['titulo' => 'Curly Hair','nombre'=>' by Rosmy Pachon','empleados'=>$empleados, 'municipios'=> $municipios, 'departamentos' => $departamentos, 'paises' => $paises, 'cargos'=> $cargos]; // le asignamos a la variable data, que es la que interactua con la vista, los datos obtenidos del modelo, ademas de enviarle una variable titulo para el reporte.
            echo view('/principal/header' , $data);
            echo view('/empleados/empleados', $data);

            //echo view('/principal/principal',$data); //mostramos la vista desde el controlador y le enviamos la data necesaria, en este caso, estamos enviando el titulo
        }   
        public function eliminados()
    {
        $empleado = $this->empleados->where('estado','E')->findAll();
        $paises = $this->paises->where('estado', 'A')->findAll(); 
        $departamentos = $this->departamentos->obtenerDepartamentos();         
        $municipio = $this-> municipios->obtenerMunicipios();
        $cargos= $this-> cargos->where('estado', "A")->findAll();     
        $data = ['titulo' => 'EMPLEADOS  ELIMINADOS', 'titulo' => 'Curly Hair','nombre'=>'by Rosmy Pachon', 'datos' => $empleado, 'municipios'=> $municipio, 'departamentos' => $departamentos, 'paises' => $paises,  'cargos'=> $cargos];

        echo view('/principal/header', $data);
        echo view('empleados/eliminados', $data);
       
    }
        
        public function buscar_Empleados($id)
        {
            $returnData = array();
            $empleados_ = $this->empleados->traer_Empleados($id);
            if (!empty($empleados_)) {
                array_push($returnData, $empleados_);
            }
            echo json_encode($returnData);
        }
        public function insertar()
        {
            $tp=$this->request->getPost('tp');
            if ($this->request->getMethod() == "post") {
                if ($tp == 1) {
                    $this->empleados->save([
                        'nombres' => $this->request->getPost('nombres'),
                        'apellidos' => $this->request->getPost('apellidos'),
                        'nacimiento' => $this->request->getPost('nacimiento'),
                        'id_pais' => $this->request->getPost('pais'),
                        'id_dpto' => $this->request->getPost('departamento'),
                        'id_municipio' => $this->request->getPost('municipio'),
                        'id_cargo' => $this->request->getPost('cargos')
                    ]);
                } else {
                    $this->empleados->update($this->request->getPost('id'),[                    
                        'nombres' => $this->request->getPost('nombres'),
                        'apellidos' => $this->request->getPost('apellidos'),
                        'nacimiento' => $this->request->getPost('nacimiento'),
                        'id_pais' => $this->request->getPost('pais'),
                        'id_dpto' => $this->request->getPost('departamento'),
                        'id_municipio' => $this->request->getPost('municipio'),
                        'id_cargo' => $this->request->getPost('cargos')
                    ]);
                }
                return redirect()->to(base_url('/empleados'));
            }
        }
        public function eliminar($id,$estado){
            $empleado_ = $this->empleados->elimina_Empleados($id,$estado);
            return redirect()->to(base_url('/empleados'));
        }
}
