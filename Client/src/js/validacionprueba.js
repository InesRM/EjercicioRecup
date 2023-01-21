import {crearPruebaEleccion} from './crud_pruebas'
import {crearPruebaValoracion} from './crud_pruebas'
import {crearPruebaPuntual} from './crud_pruebas'
import {crearPruebaRespuestaLibre} from './crud_pruebas'

export const validacion = () => {
    const pregunta = document.querySelector('.pregunta');
    const respuesta = document.querySelector('.respuesta');
    const form = document.getElementsByTagName('form')[0];
    const destino = document.querySelector('.destino');
    const habilidad = document.querySelector('.habilidad');
    const porcentaje = document.querySelector('.porcentaje');
    const descripcion = document.querySelector('.descripcion');
    const palabrasclaves = document.querySelector('.palabrasclaves');
    const palabrasclavesError = document.querySelector('.errorpalabrasclaves');
    const descripcionError = document.querySelector('.errordescripcion');
    const porcentajeError = document.querySelector('.errorporcentaje');
    const preguntaError = document.querySelector('.errorpregunta');
    const respuestaError = document.querySelector('.errorespuesta');
    const destinoError = document.querySelector('.errordestino');
    const habilidadError = document.querySelector('.errorhabilidad');
    const divModal = document.querySelector('.contenedor-modal');
    const modal = document.querySelector('.modal');

        form.addEventListener('submit', (event) => {
            limpiarError(); //Reinicia el valor de los errores
            let clase = form.classList;
            if(clase.contains('valoracion')){
                validarValoracion(event);
            }else if(clase.contains('eleccion')){
                validarEleccion(event);
            }else if(clase.contains('puntual')){
                validarPuntual(event);
            }else if(clase.contains('libre')){
                validarRespuestaLibre(event);
            }
            event.preventDefault(); 
        });

        const validarRespuestaLibre = async(event) => {
            if(!pregunta.validity.valid || !destino.validity.valid || !palabrasclaves.validity.valid || !porcentaje.validity.valid){
                mostrarError();
               event.preventDefault(); 
            } else {
                const data = new FormData(document.getElementById('formulario'));
                const prueba = Object.fromEntries(data);
                let usuario = JSON.parse(localStorage.getItem('user'));
                prueba['iddios'] = usuario.id;
                prueba['tipo']='Respuesta Libre';
                let mensaje = await crearPruebaRespuestaLibre(prueba);
                modal.style.display = "block";
                crearModalPrueba(mensaje);
                event.preventDefault();
            }
        }

        const validarPuntual = async(event) => {
            if(!descripcion.validity.valid || !destino.validity.valid || !habilidad.validity.valid || !porcentaje.validity.valid){
                mostrarError();
               event.preventDefault(); 
            } else {
                const data = new FormData(document.getElementById('formulario'));
                const prueba = Object.fromEntries(data);
                let usuario = JSON.parse(localStorage.getItem('user'));
                prueba['iddios'] = usuario.id;
                prueba['tipo']='Puntual';
                let mensaje = await crearPruebaPuntual(prueba);
                modal.style.display = "block";
                crearModalPrueba(mensaje);
                event.preventDefault();
            }
        }

        const validarValoracion = async(event) => {
            if(!pregunta.validity.valid || !destino.validity.valid || !habilidad.validity.valid){
                mostrarError();
               event.preventDefault(); 
            } else {
                const data = new FormData(document.getElementById('formulario'));
                const prueba = Object.fromEntries(data);
                let usuario = JSON.parse(localStorage.getItem('user'));
                prueba['iddios'] = usuario.id;
                prueba['tipo']='Valoracion';
                let mensaje = await crearPruebaValoracion(prueba);
                modal.style.display = "block";
                crearModalPrueba(mensaje);
                event.preventDefault();
            }
        }

        const validarEleccion = async(event) => {
            if(!pregunta.validity.valid || !respuesta.validity.valid || !destino.validity.valid || !habilidad.validity.valid){
                mostrarError();
                event.preventDefault(); 
            } else {
                const data = new FormData(document.getElementById('formulario'));
                const prueba = Object.fromEntries(data);
                let usuario = JSON.parse(localStorage.getItem('user'));
                prueba['iddios'] = usuario.id;
                prueba['tipo']='Eleccion';
                let mensaje = await crearPruebaEleccion(prueba);
                modal.style.display = "block";
                crearModalPrueba(mensaje);
                event.preventDefault();
            }
        }

    const mostrarError = () => {
        if (form.classList.contains('eleccion') || form.classList.contains('valoracion') || form.classList.contains('libre')){
            if(pregunta.validity.valueMissing) {
                preguntaError.textContent = 'Debe introduccir una pregunta';
            }
        }
        if(destino.validity.valueMissing || destino.validity.rangeOverflow || destino.validity.rangeUnderflow){
            destinoError.textContent = 'Debe introducir dígitos entre 0 y 100';
        }
        if(form.classList.contains('puntual') || form.classList.contains('eleccion') || form.classList.contains('valoracion')){
            if(habilidad.validity.valueMissing){
                habilidadError.textContent = 'Selecciona una habilidad';
            }
        }
        if (form.classList.contains('eleccion')){
            if(respuesta.validity.valueMissing){
                respuestaError.textContent = 'Debe introduccir dos respuestas';
            }
        }
        if(form.classList.contains('libre')){
            if(palabrasclaves.validity.valueMissing) {
                palabrasclavesError.textContent = 'Debe introduccir palabras claves';
            }
        }
        if(form.classList.contains('puntual') || form.classList.contains('libre')){
            if(form.classList.contains('puntual')){
                if(descripcion.validity.valueMissing) {
                    descripcionError.textContent = 'Debe introduccir una descripción';
                }
            }
            if(porcentaje.validity.valueMissing || porcentaje.validity.rangeOverflow || porcentaje.validity.rangeUnderflow){
                porcentajeError.textContent = 'Introduzca un porcentaje entre 0 y 100';
            }
        }
    }
        
    

    const limpiarError = () => {
        if (form.classList.contains('eleccion') || form.classList.contains('valoracion') || form.classList.contains('libre')){
            preguntaError.textContent = '';
        }
        destinoError.textContent = '';
        if(form.classList.contains('puntual') || form.classList.contains('eleccion') || form.classList.contains('valoracion')){
            habilidadError.textContent = '';
        }
        if (form.classList.contains('eleccion')){
            respuestaError.textContent = '';
        }
        if(form.classList.contains('libre')){
            palabrasclavesError.textContent = '';
        }
        if(form.classList.contains('puntual') || form.classList.contains('libre')){
            if(form.classList.contains('puntual')){
                descripcionError.textContent = '';   
            }
            porcentajeError.textContent = '';
        }
    }

    const crearModalPrueba = ( mensaje ) => {
        const modal = () => `
            <div class="modal-header">
                <h5 class="modal-title">Registro</h5>
            </div>
            <div class="modal-body">
                <p>${mensaje}</p>
            </div>
            <div class="modal-footer">
                <a href="./historialpruebas.html"><button type="button" class="btn-cerrar">Cerrar</button></a>
            </div>
            `;
        const div = document.createElement('div');
        div.innerHTML = modal();
        divModal.appendChild(div);
        cerrarModal();
    }

    const cerrarModal = () =>{
        const btnCerrar = document.querySelector('.btn-cerrar');
        btnCerrar.addEventListener('click', () => {
            modal.style.display = "none";
            divModal.innerHTML = '';
        });
    }
}

