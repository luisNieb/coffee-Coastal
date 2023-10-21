<?php
namespace Model;

class Usuario extends ActiveRecord{
    //base de datos
    protected static $tabla='usuarios';
    protected static $columnasDB=['id','nombre','apellido','email',
    'password','telefono','admin','confirmado' ,'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args=[]){
       $this->id = $args['id'] ?? null; //?? en caso de que no este precente toma el valor de null
       $this->nombre=$args['nombre'] ?? "";
       $this->apellido=$args['apellido'] ?? "";
       $this->email=$args['email'] ?? "";
       $this->password=$args['password'] ?? "";
       $this->telefono=$args['telefono'] ?? "";
       $this->admin=$args['admin'] ?? null;
       $this->confirmado=$args['confirmado'] ?? null;
       $this->token=$args['token'] ?? "";
       
    }

    // mensaje de validacion 
    public function validarNuevaCuenta(){

          if(!$this->nombre){
            
               self::$alertas['error'][] = 'El nombre del es obligtorio';
          }if(!$this->apellido){
               self::$alertas['error'][] = 'El apellido del  es obligatorio';
          }
          if(!$this->email){
              self::$alertas['error'][] = 'el email del es obligatorio';
          }
          if(!$this->telefono){
           
             self::$alertas['error'][] = 'el telefono es obligatorio';
          }

          if(!$this->password){
            //debuguear($password);
            
            self::$alertas['error'][] = 'el telefono es obligatorio';
         }
          if(strlen($this->password) < 6){
               self::$alertas['error'][]="el password debe contener al menos 6 caracteres";
          }

    return self::$alertas;
   }

   public function existeUsuario(){

      
      $query="SELECT * FROM ".self::$tabla." Where email = '".$this->email."' LIMIT 1";
      //debuguear($query);
      $resultado=self::$db->query($query); 
      //debuguear($resultado);

      if($resultado->num_rows){

          self::$alertas['error'][]='EL usuario ya esta registrado';
      }
      return $resultado;
    }
    public function hashPassword() {
        $this->password=password_hash($this->password,PASSWORD_BCRYPT);
    }
}   