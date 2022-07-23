<h1 class="nom-pg">Nuevo Servicio</h1>
<p class="desc-pg">Llena todos los campos para crear un nuevo Servicio</p>
<?php include_once __DIR__ . '/../templates/barra.php';?>
<?php include_once __DIR__ . '/../templates/alertas.php';?>

<form action="/servicios/crear" method="POST" class="formulario">
    <?php include_once __DIR__ . '/../servicios/formulario.php';?>
    <input type="submit" class="boton" value="Guardar Servicio">
</form>