<?php 

namespace Model;

class CitaServicio extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'citas_servicios';
    protected static $columnasDB = ['id','citasid','servicioid'];

    public $id;
    public $citasid;
    public $servicioid;

    public function __construct($args=[]){
        $this->id = $args['id'] ?? null;
        $this->citasid = $args['citasid'] ?? '';
        $this->servicioid = $args['servicioid'] ?? '';
        
    }
}
