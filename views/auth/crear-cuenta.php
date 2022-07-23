<h1 class="nom-pg">Crear Cuenta</h1>
<p class="desc-pg">Llena el siguiente formulario para crear una cuenta</p>

<?php 
 include_once __DIR__ . "/../templates/alertas.php"
?>
<form action="/crear-cuenta" class="formulario" method="POST">

    <div class="campo">
        <label for="nombre">Nombre(s)</label>
        <input type="text" placeholder="Tu Nombre" id="nombre" name="nombre" value="<?php echo s($usuario->nombre) ?>">
    </div>

    <div class="campo">
        <label for="apellidos">Apellido(s)</label>
        <input type="text" placeholder="Tu Apellido" id="apellidos" name="apellido" value="<?php echo s($usuario->apellido) ?>">
    </div>
 
    <div class="campo">
        <label for="correo">Correo</label>
        <input type="email" placeholder="Tu Email" id="correo" name="email" value="<?php echo s($usuario->email) ?>">
    </div>

    <div class="campo">
        <label for="telefono">Telefono</label>
        <input type="tel" placeholder="Tu Teléfono" id="telefono" name="telefono" value="<?php echo s($usuario->telefono) ?>">
    </div>

    <div class="campo">
        <label for="direccion">Dirección</label>
        <input type="text" placeholder="Ingresa tu direccion" id="direccion" name="direccion" value="<?php echo s($usuario->direccion) ?>">
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" placeholder="Tu Contraseña" id="contraseña" name="contraseña" ">
    </div>

    <div class="campo">
        <label for="password">Confirma tu Contraseña</label>
        <input type="password" placeholder="Confirma tu Contraseña" id="contraseña2" name="contraseña2"">
    </div>

    <input type="submit" class="boton" value="Crear Cuenta">
</form>


<div class="acciones">
    <a href="/">Ya cuento con una Cuenta | Iniciar Sesion</a>
    <a href="/olvide">Olvide mi Contraseña</a>
</div>