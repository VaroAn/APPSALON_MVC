<h1 class="nom-pg">Login</h1>
<p class="desc-pg">Iniciar Sesion Con Tus Datos</p>
<?php include_once __DIR__.'/../templates/alertas.php'; ?>
<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="correo">Correo</label>
        <input type="email" id="correo" placeholder="Tu Correo" name="email" value="<?php echo s($auth->email) ?>">
    </div>
    <div class="campo">
        <label for="contraseña">Contraseña</label>
        <input type="password" id="contraseña" placeholder="Tu Contraseña" name="contraseña">
    </div>

    <input type="submit" class="boton" value="Iniciar Sesion">

</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Deseas Crear una Cuenta?</a>
    <a href="/olvide">Olvide mi Contraseña</a>
</div>