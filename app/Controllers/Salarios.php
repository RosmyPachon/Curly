<?php

namespace App\Controllers;

use App\Controllers\BaseController; /*la plantilla del controlador general de codeigniter */
use App\Models\EmpleadosModel;
use App\Models\SalariosModel;


class Salarios extends BaseController
{
    protected $empleados;
    protected $salarios;

    public function __construct()
    {
        $this->salarios = new SalariosModel();
        $this->empleados = new EmpleadosModel();
    }
    public function index()
    {
        $salarios = $this->salarios->obtenerSalarios();
        $empleados = $this->empleados->obtenerEmpleados();

        $data = ['titulo' => 'Curly Hair','nombre'=>'by Rosmy Pachon', 'empleados' => $empleados, 'salarios' => $salarios,]; // le asignamos a la variable data, que es la que interactua con la vista, los datos obtenidos del modelo, ademas de enviarle una variable titulo para el reporte.
        echo view('/principal/header', $data);
        echo view('/salarios/salarios', $data);


        //echo view('/principal/principal',$data); //mostramos la vista desde el controlador y le enviamos la data necesaria, en este caso, estamos enviando el titulo
    }

    public function eliminados()
    {
        $salarios = $this->salarios->eliminados_salarios();
        $empleados = $this->empleados->obtenerEmpleados();
        $data = ['titulo' => 'Salarios Eliminados','nombre'=>'by Rosmy Pachon', 'salarios' => $salarios, 'empleados' => $empleados];
        echo view('/principal/header', $data);
        echo view('/salarios/eliminados', $data);
    }

    public function insertar()
    {
        $tp = $this->request->getPost('tp');
        if ($this->request->getMethod() == "post") {
            if ($tp == 1) {
                $this->salarios->save([
                    'periodo' => $this->request->getPost('periodo'),
                    'id_empleado' => $this->request->getPost('empleado'),
                    'sueldo' => $this->request->getPost('sueldo')
                ]);
                return redirect()->to(base_url('/salarios'));
            } else {
                $this->salarios->update($this->request->getPost('id'), [
                    'periodo' => $this->request->getPost('periodo'),
                    'id_empleado' => $this->request->getPost('empleado'),
                    'sueldo' => $this->request->getPost('sueldo')
                ]);
            }
            return redirect()->to(base_url('/salarios'));
        }
    }
    
    public function buscar_Salarios($id)
    {
        $returnData = array();
        $salarios_ = $this->salarios->traer_Salarios($id);
        if (!empty($salarios_)) {
            array_push($returnData, $salarios_);
        }
        echo json_encode($returnData);
    }

    public function eliminar($id, $estado)
    {

        $salarios_ = $this->salarios->elimina_Salarios($id, $estado);

        return redirect()->to(base_url('/salarios'));
    }

}