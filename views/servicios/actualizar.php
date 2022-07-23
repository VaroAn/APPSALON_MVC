<h1 class="nom-pg"> Actualizar Servicio</h1>
<p class="desc-pg">Modifica los Valores del Formulario</p>
<?php include_once __DIR__ . '/../templates/barra.php';?>
<?php include_once __DIR__ . '/../templates/alertas.php';?>


<form method="POST" class="formulario">
<?php include_once __DIR__ . '/../servicios/formulario.php';?>
    <input type="submit" class="boton" value="Actualizar Servicio">
</form>