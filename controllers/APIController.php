<?php 
      namespace Controllers;

use Model\Servicio;


      class APIController {

        public static function index() {
            
            $servicios=Servicio::all();
            //tranformamos el arreglo de la base de datos en un documento json
            echo json_encode($servicios);

      }
    }
?>