<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class UsuariosModel extends Model{
    protected $table      = 'usuarios'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType     = 'array';  /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombre_corto','nombres','apellidos','contrasena', 'estado', 'fecha_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField  = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField  = ''; /*fecha automatica para la edicion */
    protected $deletedField  = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation    = false;

    public function obtenerClientes(){
        $this->select('clientes.*');
        $datos = $this->findAll();  // nos trae todos los registros que cumplan con una condicion dada 
        return $datos;
    }

    
    // /* public function update($nombre, $id){
    //     $this->update('cargos');
    //     $this->set('nombre', $nombre);
    //     $this->where('id_cargo', $id);
    // } */
    // public function buscaCargo($id){
    //     $this->select('clientes.*');
    //     $this->where('Id_cliente', $id);
    //     $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
    //     return $datos;
    // }

    // public function traer_Pais($id){
    //     $this->select('paises.*');
    //     $this->where('id', $id);
    //     $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
    //     return $datos;
    // }
 
    // public function elimina_Pais($id,$estado){
    //     $datos = $this->update($id, ['estado' => $estado]);         
    //     return $datos;
    // }
}
