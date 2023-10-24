<?php

namespace Model;

class Usuario extends ActiveRecord
{
    //base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = [
        'id', 'nombre', 'apellido', 'email',
        'password', 'telefono', 'admin', 'confirmado', 'token'
    ];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null; //?? en caso de que no este precente toma el valor de null
        $this->nombre = $args['nombre'] ?? "";
        $this->apellido = $args['apellido'] ?? "";
        $this->email = $args['email'] ?? "";
        $this->password = $args['password'] ?? "";
        $this->telefono = $args['telefono'] ?? "";
        $this->admin = $args['admin'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? "";
    }

    // mensaje de validacion 
    public function validarNuevaCuenta()
    {

        if (!$this->nombre) {

            self::$alertas['error'][] = 'El nombre del es obligtorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El apellido del  es obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'el email del es obligatorio';
        }
        if (!$this->telefono) {

            self::$alertas['error'][] = 'el telefono es obligatorio';
        }

        if (!$this->password) {
            //debuguear($password);

            self::$alertas['error'][] = 'el telefono es obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = "el password debe contener al menos 6 caracteres";
        }

        return self::$alertas;
    }


    public function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'EL email es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'EL password es obligatorio';
        }
        return self::$alertas;
    }

    public function validarEmail()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'EL email es obligatorio';
        }
        return self::$alertas;
    }

    public function existeUsuario()
    {

        $query = "SELECT * FROM " . self::$tabla . " Where email = '" . $this->email . "' LIMIT 1";
        //debuguear($query);
        $resultado = self::$db->query($query);
        //debuguear($resultado);

        if ($resultado->num_rows) {

            self::$alertas['error'][] = 'EL usuario ya esta registrado';
        }
        return $resultado;
    }
    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function creearToken()
    {
        //asignamos el token al usuario
        $this->token = uniqid();
    }
    public function estaVerificado($password)
    {
        //comprobar el password y que este verifivado

        //le passamos el password que queremos verificar
        $resultado = password_verify($password, $this->password);
        if (!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Password Incorrecto o tu cuenta no ha sido verificada';
        } else {
            return true;
        }
    }
}
