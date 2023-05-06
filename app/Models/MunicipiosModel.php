<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class MunicipiosModel extends Model{
    protected $table      = 'municipios'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType     = 'array';  /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombre','estado', 'id_dpto']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField  = ''; /*fecha automatica para la creacion */
    protected $updatedField  = ''; /*fecha automatica para la edicion */
    protected $deletedField  = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation    = false;

    public function obtenerMunicipios(){
        $this->select('municipios.*,departamentos.nombre as nombre_departamento, paises.nombre as nombre_pais');
        $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
        $this->join('paises', 'paises.id = departamentos.id_pais');
        $this->where('municipios.estado', 'A');
        $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }

    public function traer_municipios($id){
        $this->select('municipios.*,departamentos.nombre as nombre_departamento, paises.nombre as nombre_pais, paises.id as id_pais');
        $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
        $this->join('paises', 'paises.id = departamentos.id_pais');
        $this->where('municipios.id', $id);
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }

    public function elimina_municipio($id,$estado){
        $datos = $this->update($id, ['estado' => $estado]);         
        return $datos;
    }

    public function eliminados_municipios(){
        $this->select('municipios.*,departamentos.nombre as nombre_departamento, paises.nombre as nombre_pais');
        $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
        $this->join('paises', 'paises.id = departamentos.id_pais');
        $this->where('municipios.estado', 'E');
        $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    
    public function seleccionar_Municipio($id,$estado){
        $this->select('municipios.*,
        municipios.id_dpto as iden_dpto,
        paises.id as iden_pais,
        municipios.id as iden_muni,

        municipios.nombre as nombre_muni,
        paises.nombre as nombre_pais,
        departamentos.nombre as nombre_dpto
        ');
        $this->join('departamentos','municipios.id_dpto=departamentos.id');
        $this->join('paises','departamentos.id_pais=paises.id');
        $this->where('municipios.id',$id);
        $this->where('municipios.estado',$estado);
        $datos = $this->first();           
        return $datos;
    }
    public function traer_MunicipioDepartamento($id,$estado){
        $this->select('municipios.*');   
        $this->where('municipios.id_dpto', $id);     
        $this->where('municipios.estado', $estado);
        $this->orderBY('municipios.nombre');
        $datos = $this->findAll();         
        return $datos;
    }



}
