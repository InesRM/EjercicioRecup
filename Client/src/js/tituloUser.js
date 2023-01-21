const titulo = document.querySelector('.titulo');
const data = JSON.parse(localStorage.getItem('user'));

export const init = () => {
    crearTitulo();
}

const crearTitulo = () => {
    titulo.innerHTML = `Bienvenido ${data.name}`;
}