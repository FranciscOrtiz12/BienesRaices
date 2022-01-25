<?php
    use App\Propiedad;
    
    //Clase 386
    if($_SERVER['SCRIPT_NAME'] === '/anuncios.php'){
        $propiedades = Propiedad::all();
    }else{
        $propiedades = Propiedad::get(3);
    }
?>

<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad) { ?>
    <div class="anuncio">

        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen?>" alt="Anuncio">
        
                
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo; ?></h3>
            <p><?php echo $propiedad->descripcion; ?></p>
            <p class="precio">$<?php echo $propiedad->precio; ?></p>

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

            <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div> <!-- Contenido Anuncio -->
    </div> <!-- Anuncio -->
    <?php } ?>
</div> <!-- Contenedor Anuncios -->
