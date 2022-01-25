<main class="contenedor seccion contenido-centrado">

        <h1><?php echo $propiedad->titulo; ?></h1>

        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen de la Propiedad">

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad->precio; ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icon" loading=lazy alt="icono baños" src="build/img/icono_wc.svg">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>

                <li>
                    <img class="icon" loading=lazy alt="icono estacionamiento" src="build/img/icono_estacionamiento.svg">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>

                <li>
                    <img class="icon" loading=lazy alt="icono dormitorios" src="build/img/icono_dormitorio.svg">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>

            <?php echo $propiedad->descripcion; ?>
        </div>

    </main>