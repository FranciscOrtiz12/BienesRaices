<?php

    if(!isset($_SESSION)){
        session_start();
    };
    $auth = $_SESSION['login'] ?? false; //?? si no existe, va a ser null

    if(!isset($inicio)){
        $inicio = false;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>"> <!-- Si  incio esta definido agregamos ''inicio'' : caso contrario, agregamos '' -->

        <div class="contenedor contenido-header">

            <div class="barra">
                <a href="index.php"> <!-- / Forma de indicar la pagina principal -->
                    <img src="/build/img/logo.svg" alt="Logo Empresa">
                </a>

                <div class="mobile-menu">
                    <img id="ides" src="/build/img/barras.svg" alt="Icono Menu">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth):  ?>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php endif;?>
                    </nav>

                </div>

            </div> <!-- Cierre de la barra -->

            <?php echo $inicio ? '<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>' : ''; ?>
            
        </div>

    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos Reservados <?php echo date('Y') ?> &copy;</p>
    </footer>

    <script src="/build/js/bundle.min.js"></script>
</body>
</html>