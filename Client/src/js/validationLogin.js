import { login } from "./http-provider";

const email = document.querySelector('.email');
const password = document.querySelector('.password');
const form = document.getElementsByTagName('form')[0];
const emailError = document.querySelector('.erroremail');
const passwordError = document.querySelector('.errorpassword');

export const inicializar = () =>{
    validation();
}

const validation = () => {
    form.addEventListener('submit', (event) => {
        limpiarErrorLogin();
            if(!email.validity.valid){
                mostrarErrorLogin();
                event.preventDefault();
            }
            if(!password.validity.valid){
                mostrarErrorLogin();
                event.preventDefault();
            }else{
            const data = new FormData(document.getElementById('login'));
            const usuario = Object.fromEntries(data);
            login(usuario).then(result => {
                if (result.message === 'Logged in!') {
                    const role = result.data['role'];
                    if (result.success === true && role === 'human'){
                        email.value = "";
                        password.value = "";
                        localStorage.setItem('user', JSON.stringify(result.data));
                        window.location.href = "../html/perfilHumano.html";
                    }
                    else if (result.success === true && role === 'god') {
                        email.value = "";
                        password.value = "";
                        localStorage.setItem('user', JSON.stringify(result.data));
                        window.location.href = "../html/perfilDios.html";
                    }
                    else if (result.success === true && role === 'hades') {
                        email.value = "";
                        password.value = "";
                        localStorage.setItem('user', JSON.stringify(result.data));
                        window.location.href = "../html/perfilHades.html";
                    }
                }
                else {
                    const modal = document.getElementById('modalRegistro');
                    const parrafo = document.getElementById('parrafo');
                    const close = document.getElementsByClassName('close')[0];

                    modal.style.display = 'block';
                    parrafo.innerHTML = 'Ha ocurrido un error';
                    close.addEventListener('click', (event) => {
                        modal.style.display = "none";
                    });
                }   
            });
            event.preventDefault();
        }
    });

    const mostrarErrorLogin = () =>{
        if(email.validity.valueMissing || email.validity.patternMismatch){
            emailError.textContent = 'Introduzca el email correctamente';
        }
        if(password.validity.valueMissing){
            passwordError.textContent = 'Introduzca una contraseña';
        }
    }

    const limpiarErrorLogin = () => {
        emailError.textContent = '';
        passwordError.textContent = '';
    }
}