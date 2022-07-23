<h1 class="nom-pg">Recuperar Contraseña</h1>
<p class="desc-pg">Ingresa tu Nueva Contraseña</p>
<?php include_once __DIR__.'/../templates/alertas.php'; 

if($error) return;
?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" placeholder="Tu Contraseña" id="contraseña" name="contraseña" ">
    </div>

    <div class="campo">
        <label for="password">Confirma tu Contraseña</label>
        <input type="password" placeholder="Confirma tu Contraseña" id="contraseña2" name="contraseña2"">
    </div>

    <input type="submit" class="boton" value="Guardar Cambios">
</form>

<div class="acciones">
<a href="/">Ya cuento con una Cuenta | Iniciar Sesion</a>
    <a href="/crear-cuenta">¿Deseas Crear una Cuenta?</a>
</div>