
<h1 class="nombre-pagina">Login<span></span></h1>
<p class="text-center" >Inicia sesion con tus datos</p>


<?php  include_once __DIR__.'/../templates/alertas.php'; ?>

<form class="formulario" method="POST"  action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" 
                    id="email" 
                    placeholder="tu Email" 
                    name="email"
        />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" 
                    id="password" 
                    placeholder="tu password" 
                    name="password"
        />
    </div>
         <input type="submit" class="boton" value="Iniciar sesion"/>
</form>
 
<div class="acciones">
    <a href="/crear-cuenta"> ¿Aun no tienes una cuenta? Crear una</a> 
    <a href="/olvide"> ¿Olvidaste tu password?</a> 

</div>