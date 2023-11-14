<?php
    namespace Controllers; 
    use  MVC\Router;

    class HomeController{

        public static function index(Router $router){
            $home=true;
             
             $router->render('home/index', [
                 "home" => $home
             ]);
        }
        
        public static function menu(Router $router){
            $home=true;
             
             $router->render('home/menu', [
                 "home" => $home
             ]);
        }
        public static function cita(Router $router){
            session_start();
             $home=true;
             
            $router->render('home/cita', [
                'nombre'=>$_SESSION['nombre'],
                "home" => $home
            ]);

        } 
        

    }

?>