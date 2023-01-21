const urlCrearEleccion = 'http://127.0.0.1:8000/api/prueba/eleccion/crear';
const urlCrearValoracion = 'http://127.0.0.1:8000/api/prueba/valoracion/crear';
const urlCrearPuntual = 'http://127.0.0.1:8000/api/prueba/puntual/crear';
const urlCrearRespLibre = 'http://127.0.0.1:8000/api/prueba/resplibre/crear';
const urlListPruebas = 'http://127.0.0.1:8000/api/prueba/listar';
const urlBorrarPrueba = 'http://127.0.0.1:8000/api/prueba/borrar';
const urlAsignarPrueba = 'http://127.0.0.1:8000/api/asignar/asignarprueba';
const urlPruebasAsignada= 'http://localhost:8000/api/prueba/getPruebasUser';
const urlPruebas= 'http://localhost:8000/api/prueba/listar';
let datos = JSON.parse(localStorage.getItem('user'));
let token = datos.token;

export const obtenerListaPruebas = async() => {
    const resp = await fetch(urlListPruebas, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json', 
            'Authorization': `Bearer ${token}`
        } 
    });
    const prueba = await resp.json();
    return prueba;
}

export const borrarPrueba = async(id) => {
    const resp = await fetch(`${urlBorrarPrueba}/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json', 
            'Authorization': `Bearer ${token}`
        }   
    });
}

const crearPruebaEleccion = async(prueba) => {
    const resp = await fetch(urlCrearEleccion, {
        method: 'POST',
        body: JSON.stringify(prueba),
        headers: {
            'Content-Type': 'application/json', 
            'Authorization': `Bearer ${token}`
        }
    });
    return await resp.json();
}

const crearPruebaValoracion = async(prueba) => {
    const resp = await fetch(urlCrearValoracion, {
        method: 'POST',
        body: JSON.stringify(prueba),
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        }
    });
    return await resp.json();
}

const crearPruebaPuntual = async(prueba) => {
    const resp = await fetch(urlCrearPuntual, {
        method: 'POST',
        body: JSON.stringify(prueba),
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}` 
        }
    });
    return await resp.json();
}

const crearPruebaRespuestaLibre = async(prueba) => {
    const resp = await fetch(urlCrearRespLibre, {
        method: 'POST',
        body: JSON.stringify(prueba),
        headers: {
            'Content-Type': 'application/json' ,
            'Authorization': `Bearer ${token}`
        }
    });
    return await resp.json();
}

export const insertarUsuariosAsignados = async(idusuario, idprueba) =>{
    const resp = await fetch(urlAsignarPrueba, {
        method: 'POST',
        body: JSON.stringify({idusuario:idusuario, idprueba:idprueba}),
        headers: {
            'Content-Type': 'application/json' ,
            'Authorization': `Bearer ${token}`
        }
    });
}

export const obtenerPruebasAsignadas = async(id) =>{
    const resp = await fetch(`${urlPruebasAsignada}/${id}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json' ,
        }
    });
    const prueba = await resp.json();
    return prueba;
}

export const obtenerPruebas = async() =>{
    const resp = await fetch(urlPruebas, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json' ,
        }
    });
    const prueba = await resp.json();
    return prueba;
}


export {
    crearPruebaEleccion,
    crearPruebaValoracion,
    crearPruebaPuntual,
    crearPruebaRespuestaLibre
    
}