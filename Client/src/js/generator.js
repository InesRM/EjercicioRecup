import { generateUsers } from "./http-provider";

const form = document.getElementsByTagName('form')[0];
const number = document.querySelector('.number');

export const initGenerate = () => {
    generateHuman();
}

const generateHuman = () => {
    form.addEventListener('submit', (event) => {
        const data = new FormData(document.getElementById('generador'));
        const generator = Object.fromEntries(data);
        const locale = JSON.parse(localStorage.getItem('user'));
        generator['id'] = locale.id;
        generateUsers(generator).then(result => {
            const modal = document.getElementById('modalRegistro');
            const parrafo = document.getElementById('parrafo');
            const close = document.getElementsByClassName('close')[0];
            if (result.success === true){
                parrafo.innerHTML = 'Humanos generados correctamente';
                modal.style.display = 'block';
                close.addEventListener('click', (event) => {
                    modal.style.display = "none";
                }) 
                number.value = '';
            }
            else {
                modal.style.display = 'block';
                parrafo.innerHTML = 'Ha ocurrido un error';
                close.addEventListener('click', (event) => {
                    modal.style.display = "none";
                }) 
            }
        });
        event.preventDefault()
    });
}