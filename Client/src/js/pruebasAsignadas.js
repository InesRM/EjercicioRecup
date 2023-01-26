import { obtenerPruebasAsignadas } from "./crud_pruebas";
import { obtenerUsuario } from "./crud_usuarios";
import { obtenerPruebas } from "./crud_pruebas";

const divListaPruebas = document.querySelector(".contenedor-tabla-pruebas");

const divLista = document.querySelector(".contenedor-tabla");
export const divModal = document.querySelector(".contenedor-modal");
export const modal = document.querySelector(".modal");

export const initPruebas = async () => {
  const pruebas = await obtenerPruebasAsignadas();
  obtenerPruebas(pruebas);
  obtenerUsuario(pruebas);
  pruebas.forEach(crearFilaPrueba);
};

const crearFilaPrueba = (prueba) => {
  const fila = (dios, fecha) => `
    <div class="card mb-3" id="p${prueba.id}">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-2">${prueba.tipo}</div>
                <div class="col-1">${dios}</div>
                <div class="col-4">${prueba.pregunta}</div>
                <div class="col-1">${prueba.destino}</div>
                <div class="col-3">${fecha.replace("T", " | ")}</div>
                <div class="col-1 acciones">
                    <div class="row">
                        <div class="col-6"><i class="fa fa-pencil-square edit" aria-hidden="true"></i></div>
                        <div class="col-6"><i class="fa fa-trash delete" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;
  let dios = nombreDios(prueba.iddios);
  let fecha = prueba.fecha.slice(0, -8);
  const div = document.createElement("div");
  div.innerHTML = fila(dios, fecha);
  divLista.appendChild(div);
};

export const nombreDios = (id) => {
  let dios = "";
  switch (id) {
    case 1:
      dios = "Zeus";
      break;
    case 2:
      dios = "Poseidon";
      break;
    case 3:
      dios = "Hades";
      break;
  }
  return dios;
};
