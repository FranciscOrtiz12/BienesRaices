<main class="contenedor seccion">

        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">

            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad expedita nobis ducimus sunt amet similique maxime blanditiis perferendis, nemo eveniet, ratione dolore repellat maiores commodi dicta consequatur iure accusamus excepturi eos, cumque quas tempora dignissimos culpa iste. Optio et vero rem voluptas natus iusto ducimus alias minus, facere eius praesentium?</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad expedita nobis ducimus sunt amet similique maxime blanditiis perferendis, nemo eveniet, ratione dolore repellat maiores commodi dicta consequatur iure accusamus excepturi eos, cumque quas tempora dignissimos culpa iste. Optio et vero rem voluptas natus iusto ducimus alias minus, facere eius praesentium?</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad expedita nobis ducimus sunt amet similique maxime blanditiis perferendis, nemo eveniet, ratione dolore repellat maiores commodi dicta consequatur iure accusamus excepturi eos, cumque quas tempora dignissimos culpa iste. Optio et vero rem voluptas natus iusto ducimus alias minus, facere eius praesentium?</p>
            </div>


        </div>

    </main>

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>

        <?php

            $limite = 3;
            include 'listado.php';
        ?> 

        <div class="alinear-derecha">
            <a class="boton-verde" href="/propiedades">Ver Todas</a>
        </div>

    </section>

    <section class="imagen-contacto">

        <h2>Encuentra La Casa de Tus Sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a class="boton-amarillo" href="">Contactános</a>

    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">

                <div class="iamgen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

                        <p>
                            Consejos para construir una terraza en el techo de tu casa con los mejores amteriales y ahorrando dinero
                        </p>

                    </a>
                </div>

            </article>

            <article class="entrada-blog">

                <div class="iamgen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guía para la decoracion de tu hogar</h4>
                        <p class="informacion-meta" >Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

                        <p>
                            Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio
                        </p>
                        
                    </a>
                </div>

            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atencion y la cas que me ofrecieron comple con todas las expectativas.
                </blockquote>
                <p>Francisco Ortiz</p>
            </div>
        </section>
    </div>