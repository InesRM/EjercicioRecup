import { obtenerPruebasAsignadas } from "./crud_pruebas";
import { obtenerUsuario } from "./crud_usuarios";
import { obtenerPruebas } from "./crud_pruebas";

const data=JSON.parse(localStorage.getItem('data'));
// const name=data.name;
// const id=data.id;
// const destino=data.destino;
// const pregunta=data.pregunta;
// const tipo=data.tipo;
const idP=document.querySelector('.id');
const nameP=document.querySelector('.name');
const destinoP=document.querySelector('.destino');
const preguntaP=document.querySelector('.pregunta');
const tipoP=document.querySelector('.tipo');


export const init = () => {
    agregarPruebasAsignadas();
}

const agregarPruebasAsignadas = ($id) => {
    obtenerPruebasAsignadas($id).then((pruebasAsignadas) => {
        pruebasAsignadas.forEach((pruebaAsignada) => {
            obtenerUsuario().then((usuarios) => {
                usuarios.forEach((usuario) => {
                    if (usuario.idusuario === pruebaAsignada.idusuario) {
                        obtenerPruebas().then((pruebas) => {
                            pruebas.forEach((prueba) => {
                                if (prueba.idprueba === pruebaAsignada.idprueba) {
                                    idP.innerHTML = `id: ${pruebaAsignada.id}`;
                                    nameP.innerHTML = `name: ${usuario.nameP}`;
                                    destinoP.innerHTML = `destino: ${prueba.destinoP}`;
                                    preguntaP.innerHTML = `pregunta: ${prueba.preguntaP}`;
                                    tipoP.innerHTML = `tipo: ${prueba.tipo}`;
                                }
                            });
                        });
                    }
                });
            });
        });
    }
    );
}



// const AgregarPruebasAsignadas = async() => {
//     obtenerPruebasAsignadas().then((pruebasAsignadas) => {
//         pruebasAsignadas.forEach((pruebaAsignada) => {
//             obtenerUsuario().then((usuarios) => {
//                 usuarios.forEach((usuario) => {
//                     if (usuario.idusuario === pruebaAsignada.idusuario) {
//                         obtenerPruebas().then((pruebas) => {
//                             pruebas.forEach((prueba) => {
//                                 if (prueba.idprueba === pruebaAsignada.idprueba) {
//                                     const row = document.createElement('tr');
//                                     row.innerHTML = `
//                                         <td>${pruebaAsignada.id}</td>
//                                         <td>${usuario.name}</td>
//                                         <td>${prueba.destino}</td>
//                                         <td>${prueba.pregunta}</td>
//                                         <td>${prueba.tipo}</td>
//                                         <td><a href="prueba.html?id=${prueba.idprueba}">Ver</a></td>
//                                     `;
//                                     document.getElementById('pruebasAsignadas').appendChild(row);
                                    
//                                 }
//                             });
//                         });
//                     }
//                 });
//             });
//         });
//     }
//     );
// }


