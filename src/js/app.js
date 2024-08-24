document.addEventListener('DOMContentLoaded', function(){
    eventListeners();
    darkMode();
});

function eventListeners(){
    const mobilMenu = document.querySelector('.mobile-menu');
    mobilMenu.addEventListener('click', navegacionResponsive);
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input=>input.addEventListener('click', mostrarMetodosContacto));
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}

function darkMode(){
    const preferenceDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    controlPreference(preferenceDarkMode);
    preferenceDarkMode.addEventListener('change', controlPreference(preferenceDarkMode));
    const btnDarkMode = document.querySelector('.dark-mode-boton');
    btnDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode')
    });
}

function controlPreference(preferenceDarkMode){
    if(preferenceDarkMode.matches){
        document.body.classList.add('dark-mode')
    }else{
        document.body.classList.remove('dark-mode')
    } 
}

function mostrarMetodosContacto(event){
    const contactoDiv = document.querySelector('#contacto');
    if(event.target.value === 'telefono'){
        contactoDiv.innerHTML = `
            <label for="telefono">Teléfono</label>
            <input type="tel" placeholder="123456789" id="telefono" name="contacto[telefono]">

            <p>Seleccione la fecha y la hora en la que desea ser contactado</p>
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    }else{
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="correo@correo.com" id="email" name="contacto[email]" required>
        `;
    }
}