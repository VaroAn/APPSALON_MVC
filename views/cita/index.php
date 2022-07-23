<h2 class="nom-pg">Crear Nueva Cita</h2>
<p class="desc-pg">Elige tus Servicios y Coloca tus Datos</p>

<?php include_once __DIR__.'/../templates/barra.php'?>
<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Informacion Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>
    <div id="paso1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuacion</p>
        <div id="servicios" class="list-serv"></div> 
    </div>
    <div id="paso2" class="seccion">
    <h2>Tus Datos y Cita</h2>
        <p class="text-center">Coloca tus Datos y Fecha de tu Cita</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" placeholder="Tu Nombre" value="<?php echo s($nombre); ?>" disabled>
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input id="fecha" type="date" min="<?php echo date('Y-m-d',strtotime('+1 day')); ?>">
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input id="hora" type="time">
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>
    <div id="paso3" class="seccion contenido-resumen">
    <h2>Resumen</h2>
        <p class="text-center">Verifica que la informacion sea Correcta</p>
    </div>
    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>

<?php $script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/app.js'></script>    
";  ?>