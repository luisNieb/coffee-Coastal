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

               //crear un usuario
                 $resultado=$usuario->guardar();
                 if($resultado){
                 header('location: /mensaje');
                
               }


               debuguear($usuario);
              }
     
           }
            
        }
         $router->render('auth/crear-cuenta', [
            //pasamos la referecia del usuario  a la vista
            "usuario"=>$usuario,
            'alertas'=>$alertas
         ]);
    }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router){ 
      $alertas=[];
       
      //obtener el token de la url sanitizarlo para evitar inyeccione de codigo
      $token=s($_GET["token"]);

      $usuario=Usuario::where('token',$token);
     

      if(empty($usuario)){
        //mostrar mensje de errorr
        Usuario::setAlerta('error',"token no valido");
      

      }else{
         //modificar a asuario confirmado
         $usuario->confirmado="1"; //confirmado cambia a 1
         $usuario->token=null; //borramos el token
         $usuario->guardar();// acutuallizamos datos de usuario
         Usuario::setAlerta('exito','cuenta comprobada correctamente');

      }

      $alertas=Usuario::getAlertas();

      //renderizar la vista
      $router->render('auth/confirmar-cuenta',[
        'alertas'=>$alertas
      ]);
  }


}