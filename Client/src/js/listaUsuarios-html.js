import {conseguirHumanosDios} from './crud_usuarios'
import { Usuario } from './classes/Usuario';
import { listUsuarios } from './listadoUsuarios';

const divListaUsuarios = document.querySelector('.contenedor-tabla-usuarios');

export const inicio = async() => {
    let usuario = JSON.parse(localStorage.getItem('user'));
    const usuarios = await conseguirHumanosDios(usuario.id);
    usuarios.forEach(crearUsuario);
}

const crearUsuario = (usuario) => {
    let newUsuario = new Usuario(usuario.id, usuario.name, usuario.email, usuario.avatar, usuario.role);
    listUsuarios.nuevoUsuario(newUsuario) ;
    crearFilaUsuario(newUsuario);
}

const crearFilaUsuario = ( usuario ) => {
    const fila = () => `
    <div class="card mb-3" id="p${usuario.id}">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-2"><i class="fa fa-user" aria-hidden="true"></i></div>
                <div class="col-2">${usuario.id}</div>
                <div class="col-4">${usuario.nombre}</div>
                <div class="col-4">${usuario.email}</div>
            </div>
        </div>
    </div>
    `;
    const div = document.createElement('div');
    div.innerHTML = fila ();
    divListaUsuarios.appendChild(div);
}