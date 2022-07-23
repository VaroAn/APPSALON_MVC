<h1 class="nom-pg">Olvide la Contraseña</h1>
<p class="desc-pg">Reestablece tu contraseña escribiendo tu email a continuacion</p>
<?php include_once __DIR__.'/../templates/alertas.php'; ?>
<form action="/olvide" method="POST" class="formulario">
<div class="campo">
        <label for="correo">Correo</label>
        <input type="email" id="correo" placeholder="Tu Correo" name="email">
    </div>
    <input type="submit" class="boton" value="Enviar Correo de Recupracion">

</form>

<div class="acciones">
    <a href="/">Ya cuento con una Cuenta | Iniciar Sesion</a>
    <a href="/crear-cuenta">¿Deseas Crear una Cuenta?</a>
</div>