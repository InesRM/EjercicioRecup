const urlUsuariosAfines = 'http://127.0.0.1:8000/api/asignar/listar/usuarioafin';
const urlUsuariosProtegidos = 'http://127.0.0.1:8000/api/asignar/listar/usuarioprotegido';
const urlUsuariosAsignados = 'http://127.0.0.1:8000/api/asignar/listar/usuariosasignados';
const urlUsuariosDios = 'http://127.0.0.1:8000/api/asignar/listar/usuariosdios';
const urlObtenerUsuario = 'http://127.0.0.1:8000/api/user/get';
let datos = JSON.parse(localStorage.getItem('user'));
let token = datos.token;

export const conseguirHumanosAfines = async(id, idprueba) => {
    const resp = await fetch(`${urlUsuariosAfines}/${id}/${idprueba}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json', 
            'Authorization': `Bearer ${token}`
        } 
    });
    const usuario = await resp.json();
    return usuario;
}

export const conseguirHumanosDios = async(id) => {
    const resp = await fetch(`${urlUsuariosDios}/${id}` , {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json', 
            'Authorization': `Bearer ${token}`
        } 
    });
    const usuario = await resp.json();
    return usuario;
}

export const conseguirHumanosProtegidos = async(id, idprueba) => {
    const resp = await fetch(`${urlUsuariosProtegidos}/${id}/${idprueba}` , {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json', 
            'Authorization': `Bearer ${token}`
        } 
    });
    const usuario = await resp.json();
    return usuario;
}

export const conseguirHumanosAsignados = async(idprueba) => {
    const resp = await fetch(`${urlUsuariosAsignados}/${idprueba}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json', 
            'Authorization': `Bearer ${token}`
        } 
    });
    const usuario = await resp.json();
    return usuario;
}

export const obtenerUsuario = async(id) => {
    const resp = await fetch(`${urlObtenerUsuario}/${id}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        }
    });
    const usuario = await resp.json();
    return usuario;
}