<h1 class="nombre-pagina">Panel de Administración</h1>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>


<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
                type="date" 
                id="fecha" 
                name="fecha" 
                value="<?php echo $fecha; ?>"
            >
        </div>
    </form>
</div>

<?php
    if(count($citas) === 0) {
        echo "<h2>No hay Citas en esta fecha</h2>";
    }
?>


<div id="citas-admin">
    <ul class="citas">
        <?php
            $idCita = null;
            foreach($citas as $key => $cita) {
                
                // $key va a ser la posición de la cita en el arreglo


                // Evita que se repitan los datos de las citas con el mismo id
                if($idCita !== $cita->id) {  
                    
                    // Inicializamos el precio total de los servicios de $cita en 0
                    $total = 0;       
        ?>

                    <li>
                    <p>ID: <span><?php echo $cita->id; ?></span></p>
                    <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                    <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                    <p>Email: <span><?php echo $cita->email; ?></span></p>
                    <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>
                    <h3>Servicios</h3>
                <?php 
                    $idCita = $cita->id;
                } // FIN DEl IF 
                
                    // Sumamos el precio de casa Servicio de $cita
                    $total += $cita->precio; // Va sumando
                ?>

                <p class="servicio"><?php echo $cita->servicio . " $" . $cita->precio; ?></p>
                
                <?php 
                // Sumar el precio total de los servicios

                $actual = $cita->id;
                $proximo = $citas[$key+1]->id ?? 0;

                if(esUltimo($actual, $proximo)) { ?>
                    <p class="total">Total: <span><?php echo "$" . $total; ?></span></p>

                    <form action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $cita->id ?>">
                        <input type="submit" class="boton-eliminar" value="Eliminar">
                    </form>

                <?php } ?>
        <?php 
        } // FIN DEL FOREACH
        ?>
    </ul>
</div>

<?php
    $script = "<script src='build/js/buscador.js'></script";
?>