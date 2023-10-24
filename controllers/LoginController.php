<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;


class LoginController{
    public static function login(Router $router){
       $alertas=[];
       $home=false;
             if($_SERVER['REQUEST_METHOD'] == 'POST'){

                 $auth=new Usuario($_POST);
                 $alertas= $auth->validarLogin();
                
                 //debuguear($alertas);
                 //si las alertas estan vacias
                 if(empty($alertas)){
                    //comprobar que existe el usuario
                    $usuario=Usuario::where('email',$auth->email);
                  
                    if($usuario){
                      //verificar que el usuario este verificado
                       if($usuario->estaVerificado($auth->password)){
                          
                          session_start();
                          $_SESSION['id']=$usuario->id;
                          $_SESSION['nombre']=$usuario->nombre." ". $usuario->apellidos;
                          $_SESSION['email']=$usuario->email;
                          $_SERVER['login']=true;
                          //redireccinamiento
                          if($usuario->admin==="1"){
                              $_SESSION['admin']=$usuario->admin ?? null;
                              header("Location:/admin");
                          }else{
                              header("Location:/home");

                          }
                       }

                    }else{
                      Usuario::setAlerta('error', 'Usuario no valido');
                    }
                 }

             }
             $alertas=Usuario::getAlertas();


         $router->render('auth/login',[
              'alertas' => $alertas, "home" => $home   //pasamos las alertas a la vista
         ]);
    }

    public static function logout(){
        echo "desede logout";
    }

    public static function olvide(Router $router){
      $home=false;
            $alertas=[];
            if($_SERVER['REQUEST_METHOD']==='POST'){
               $auth=new Usuario($_POST);
               $alertas=$auth->ValidarEmail();

               if (empty($alertas)){
                $usuario=Usuario::where('email',$auth->email);
                

                 if($usuario && $usuario->confirmado ==='1'){
                    //generar un token
                    $usuario->creearToken();
                    $usuario->guardar();

                  // TODO: enviar el email
                  $email= new Email($usuario->email,$usuario->nombre,$usuario->token) ;
                  $email->enviarInstrucciones() ;

                  // Alerta de exito
                  Usuario::setAlerta('exito','Revisa Tu email');
                    
                 }else{
                    Usuario::setAlerta('error','El usuario no existe o no esta confirmado');
                    $alertas=Usuario::getAlertas();
                 }
                  
               }

            }

            $router->render('auth/olvide-password',[
                 'alertas' => $alertas,
                 "home" => $home
            ]);
    }

    public static function recuperar(Router $router){
        $home=false;
         $alertas=[];
         $error=false;
         $token=s($_GET['token']);
         $usuario=Usuario::where('token',$token);

         if(empty($usuario)){
             Usuario::setAlerta('error', 'token no valido');
             $error=true;
         }
         
         if($_SERVER["REQUEST_METHOD"]==='POST'){
             //leer nuevo password
             $passwordNuevo=new Usuario($_POST);
             $alertas=$passwordNuevo->validarPassword();
             
             if(empty($alertas)){
                 $usuario->password=null;

                 $usuario->password= $passwordNuevo->password;
                 $usuario->hashPassword();
                 $usuario->token=null;

                 $resultado=$usuario->guardar();
                 if ($resultado){
                  header('location: /');
                 }
  
             }    
         }

        $alertas=Usuario::getAlertas();
        $router->render('auth/recuperar',[
          'alertas' => $alertas,
          'error' => $error,
          "home" => $home
        ]);


        
    }

    public static function crear(Router $router){
      $home=false;
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
               
              }
     
           }
            
        }
         $router->render('auth/crear-cuenta', [
            //pasamos la referecia del usuario  a la vista
            "usuario"=>$usuario,
            'alertas'=>$alertas,
            "home" => $home
         ]);
    }

    public static function mensaje(Router $router){
      $home=false;
        $router->render('auth/mensaje',[ "home" => $home]);
    }

    public static function confirmar(Router $router){ 
      $alertas=[];
      $home=false;
       
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
        'alertas'=>$alertas,
        "home" => $home
      ]);
  }
  

}