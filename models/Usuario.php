<?php
namespace Model;

class Usuario extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'contraseña', 'telefono', 'direccion', 'admin', 'confirmado', 'token'];
    
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $contraseña;
    public $contraseña2;
    public $telefono;
    public $direccion;
    public $admin;
    public $confirmado;
    public $token;
    
    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->contraseña = $args['contraseña'] ?? '';
        $this->contraseña2 = $args['contraseña2'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }
   
    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = "El Nombre es obligatorio";
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = "Los Apellidos son obligatorios";
        }
        if(!$this->email) {
            self::$alertas['error'][] = "El Correo es obligatorio";
        }
        if(!$this->contraseña) {
            self::$alertas['error'][] = "La contraseña es obligatoria";
        }
        if(!$this->direccion) {
            self::$alertas['error'][] = "La direccion es obligatoria";
        }
        return self::$alertas;
    }

    public function existeUsuario() {
        // Revisar si el usuario existe.
        $query = "SELECT * FROM ".self::$tabla." WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        $query2 = "SELECT * FROM ".self::$tabla." WHERE telefono = '" . $this->telefono . "' LIMIT 1";
        $resultado2 = self::$db->query($query2);

        if($resultado->num_rows) {
            self::$alertas['error'][] = 'El correo INGRESADO YA ESTA REGISTRADO';
            if($resultado2->num_rows) {
                self::$alertas['error'][] = 'El telefono INGRESADO YA ESTA REGISTRADO';
                return $resultado;
            }else{
                return $resultado;
            }
        }else if($resultado2->num_rows) {
            self::$alertas['error'][] = 'El telefono INGRESADO YA ESTA REGISTRADO';
            return $resultado;
        }else{
            return;
        }        
    }

    public function confirmarPass(){
        if(!$this->contraseña) {
            self::$alertas['error'][] = "La contraseña es obligatoria";
        }else if($this->contraseña<>$this->contraseña2){
            self::$alertas['error'][]="Las contraseñas no coinciden";
        }else if(strlen($this->contraseña)<8){
            self::$alertas['error'][]="La contraseña debe contener al menos 8 caracteres";
            
        }
        // else if(preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{3,}$/", $this->contraseña)){
        //     self::$alertas['error'][]="La contraseña debe tener al menos un caracter especial, un número y una letra";
        // }
        return self::$alertas;
    }

    public function hashPass(){
        $this->contraseña=password_hash($this->contraseña, PASSWORD_BCRYPT);
        $this->contraseña2=password_hash($this->contraseña2, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid(); 
    }

    public function verificarPassVeri($contraseña) {

        $resultado = password_verify($contraseña, $this->contraseña);

        if(!$this->confirmado){
            self::$alertas['error'][]="El Usuario aun no esta confirmado, Favor de checar su correo"; 
        }else if(!$resultado){
            self::$alertas['error'][]="La Contraseña es Incorrecta";
        }
        return $resultado;

    }

      public function validarLogin() {
         if(!$this->email) {
             self::$alertas['error'][] = "El Correo del usuario es obligatorio";
         }
         if(!$this->contraseña) {
             self::$alertas['error'][] = "La Contraseña del usuario es obligatorio";
         }
         return self::$alertas;
     }

     public function validarEmail(){
        if(!$this->email) {
            self::$alertas['error'][] = "El Correo del usuario es obligatorio";
        }
        return self::$alertas;
     }

   

}

