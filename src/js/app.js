document.addEventListener('DOMContentLoaded', function(){
    eventListeners();

    darkMode();
});

function darkMode(){

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    //console.log(prefiereDarkMode.matches)
    function cambiardarkmode(){
        if(prefiereDarkMode.matches === true){
            document.body.classList.add('dark-mode');
        }else{
            document.body.classList.remove('dark-mode');
        }
    }

    prefiereDarkMode.addEventListener('change', () => {
        cambiardarkmode();
    })
     
    const botonDark = document.querySelector('.dark-mode-boton');
    
    botonDark.addEventListener('click', function(){

        document.body.classList.toggle('dark-mode');

    });

}

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    //Muestra Campos Condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
};

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');


    //navegacion.classList.toggle('mostrar') //ESTE LINEA DE CODIGO HACE LO MISMO QUE LO ANTERIOR... EVALUA SI TIENE LA CLASE MOSTRAR, Y LUEGO LA AGREGA O LA QUITA DEPENDIENDO DE IS LA TIENE O NO

    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');
    }else{
        navegacion.classList.add('mostrar');
    }
};

function mostrarMetodosContacto(e){
    const contactoDiv = document.querySelector('#contacto');
    if(e.target.value === 'telefono'){
        contactoDiv.innerHTML = `
        <label for="telefono">Tu Numero de Teléfono:</label>
        <input type="tel" placeholder="Tu telefono" id="telefono" name="contacto[telefono]">

        <p>Elija la fecha y la hora para la llamada</p>

        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora</label>
        <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    }else{
        contactoDiv.innerHTML = `
            <label for="email">E-mail:</label>
            <input type="email" placeholder="Tu E-mail" id="email" name="contacto[email]" >
        `;
    }
}