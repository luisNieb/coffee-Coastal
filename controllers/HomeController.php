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


    }

?>