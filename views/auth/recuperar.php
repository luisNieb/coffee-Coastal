<h1 class="nombre-pagina">Restablecer Password</h1>
<p class="text-center">Coloca tu nuevo password acontinuacion</p>

<?php  include_once __DIR__.'/../templates/alertas.php'; ?>


<form class="formulario" method="POST">
<div class="campo">
        <label for="password">Password</label>
        <input type="password" 
                    id="password" 
                    placeholder="tu password" 
                    name="password"
        />
    </div>
         <input type="submit" class="boton" value="Gurdar Nuevo"/>
</form>

<div class="acciones">
    <a href="/"> ¿Ya tienes cuenta? Iniciar Sesion</a> 
    <a href="/crear-cuenta"> ¿Aun no tienes cuenta? Obtener una</a> 

</div>

