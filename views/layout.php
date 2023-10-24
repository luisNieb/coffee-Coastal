<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooffe coastal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>

   <?php 
    //no carga las vistas de formulario
    if(!$home):; 
     ?>
    <div class="contenedor-app" >
        <div class="imagen">

        </div>

        <div class="app">
            <?php echo $contenido; ?>
        </div>
        
    </div>
    <?php endif;  ?>
    
    <?php 
    //carga las vistas de home
    if($home):;  ?>

    <?php echo $contenido; ?>

    
    <?php endif;  ?>
            
</body>
</html>