<?php  include_once __DIR__.'/../templates/navegacion.php'; ?>

<section class="reservacion contenedor">
<h1 class="nombre-pagina">Crear nueva Reservacion </h1>
<p class="descripcion-pagina text-center">Elige tus servicios y coloca los tus datos</p>

<div class="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso='1'>Productos</button>
        <button type="button" data-paso='2'>Informacion Reservacion</button>
        <button type="button" data-paso='3'>Resumen</button>
    </nav>

    <div class="seccion" id="paso-1">
        <h2>Productos</h2>
        <p class="text-center">Elige tus productos a continuacion</p>
        <div id="servicios" class="listado-servicios"></div>

    </div>
    <div class="seccion" id="paso-2">
        <h2>Tus datos y Reservacion</h2>
        <p class="text-center">Coloca tus datos y fecha de tu Reservacion</p>

        <form action="" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="tu nombre" value="<?php echo $nombre ?> " disabled>
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha"  min="<?php echo date('Y-m-d' ,strtotime('+1 day'));?>">
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" id="hora">
            </div>

        </form>

    </div>
    <div class="seccion contenido-resumen" id="paso-3">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la informacion sea correcta</p>

    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente&raquo;</button>
    </div>
</div>
</section>

<?php
//el script solo esta disponible en esta vista
 echo $scrip=" <script src='build/js/app.js'></script> "?>