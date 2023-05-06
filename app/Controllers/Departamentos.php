<?php

namespace App\Controllers;

use App\Controllers\BaseController; /*la plantilla del controlador general de codeigniter */
use App\Models\DepartamentosModel;
use App\Models\PaisesModel;

class Departamentos extends BaseController
{
    protected $departamentos;
    protected $paises;
    public function __construct()
    {
        $this->departamentos = new DepartamentosModel();
        $this->paises = new PaisesModel();
    }
    public function index()
    {
        $departamentos = $this->departamentos->obtenerDepartamentos();
        $paises = $this->paises->where('estado', 'A')->findAll();
        $data = ['titulo' => 'Curly Hair', 'nombre' => ' by Rosmy Pachon', 'departamentos' => $departamentos, 'paises' => $paises]; // le asignamos a la variable data, que es la que interactua con la vista, los datos obtenidos del modelo, ademas de enviarle una variable titulo para el reporte.
        echo view('/principal/header', $data);
        echo view('/departamentos/departamentos', $data);
        //echo view('/principal/principal',$data); //mostramos la vista desde el controlador y le enviamos la data necesaria, en este caso, estamos enviando el titulo
    }

    public function buscar_departamento($id)
    {
        $returnData = array();
        $departamento_ = $this->departamentos->traer_departamento($id);
        if (!empty($departamento_)) {
            array_push($returnData, $departamento_);
        }
        echo json_encode($returnData);
    }

    public function insertar()
    {
        $tp=$this->request->getPost('tp');
        if ($this->request->getMethod() == "post") {
            if ($tp == 1) {
                $this->departamentos->save([
                    'id_pais' => $this->request->getPost('pais'),
                    'nombre' => $this->request->getPost('nombre')
                ]);
            } else {
                $this->departamentos->update($this->request->getPost('id'),[         
                    'id_pais' => $this->request->getPost('pais'),           
                    'nombre' => $this->request->getPost('nombre')
                ]);

            }
            return redirect()->to(base_url('/departamentos'));
        }
    }

    public function eliminados()
    {
        $departamentos = $this->departamentos->eliminados_Departamentos();
        $paises= $this->paises->where('estado', "A")->findAll();
        $data = ['titulo' => 'DEPARTAMENTOS ELIMINADOS', 'titulo' => 'Curly Hair','nombre'=>'by Rosmy Pachon', 'departamentos' => $departamentos, 'paises' => $paises];
        echo view('/principal/header', $data);
        echo view('departamentos/eliminados', $data);
       
    }

    public function eliminar($id,$estado){
        $departamentos_ = $this->departamentos->elimina_Departamentos($id,$estado);
        return redirect()->to(base_url('/departamentos'));
    }
    public function buscar_DepartamentosPais($id)
    {
        $returnData = array();
        $dptos = $this->departamentos->traer_DepartamentosPais($id,'A');
        if (!empty($dptos)) {
            array_push($returnData, $dptos);
        }
        echo json_encode($returnData);
    }

}
