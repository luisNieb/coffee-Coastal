<h1 class="nombre-pagina">Olvide Password</h1>
<p class="text-center">Reestablece tu passwor escribiendo tu Email acontinuacion</p>

<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
            <label for="email">Password</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="tu email">
     </div>
     <input type="submit" class="boton" value="Enviar Instrucciones">

</form>

<div class="acciones">
    <a href="/"> ¿Ya tienes una cuenta? Inicia sesion</a> 
    <a href="/olvide"> ¿Aun no tienes una cuenta? Crear una</a> 
</div>