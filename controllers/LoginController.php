<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;


class LoginController{
    public static function login(Router $router){
         $router->render('auth/login');
    }

    public static function logout(){
        echo "desede logout";
    }

    public static function olvide(Router $router){
            $router->render('auth/olvide-password',[

            ]);
    }

    public static function recuperar(){
        echo "Recuperar cuenta";
    }

    public static function crear(Router $router){

        $usuario=new Usuario;
        $alertas=[];//arrglo de alertas

        if($_SERVER['REQUEST_METHOD']==='POST'){
            //realizar las validaciones del usuario
            
            $usuario->sincronizar($_POST);
            $alertas=$usuario->validarNuevaCuenta();
           //debuguear($usuario);

           //rebisar que alertas esta vacio
           if(empty($alertas)){
              //echo 'pasaste la validacion';
              $resultado= $usuario->existeUsuario();
            
              if($resultado->num_rows){
                $alertas=Usuario::getAlertas();
              }else{
                //no esta registrado
                //hashear el password
                $usuario->hashPassword();
                $usuario->creearToken();
                
              //enviar el email 
               $email= new Email($usuario->email ,$usuario->nombre, $usuario->token);
               
               $email->enviarConfirmacion();
              }
     
           }
            
        }
         $router->render('auth/crear-cuenta', [
            //pasamos la referecia del usuario  a la vista
            "usuario"=>$usuario,
            'alertas'=>$alertas
         ]);
    }
}