import { getAttributes, getAvatar} from "./http-provider";

const data = JSON.parse(localStorage.getItem('user'));
const id = data.id;
const destino = data.destino;
const protection = data.protection;
const destinoP = document.querySelector('.destino');
const protectionP = document.querySelector('.protection');
let avatar = document.querySelector('#avatar');
let tBody = document.querySelector('tbody');
let file = document.getElementById('file');
const body = document.body;
let inputFile, imgFoto;


export const init = () => {
    getAttributes(id).then(result => {
        console.log(result.attributes);
        crearFilaAtributos(result.attributes);
    })
}

export const initDestino = () => {
    agregarDestino();
}

export const initProtection = () => {
    agregarProtection();
}
 
export const initAvatar = () => {   
 getAvatar(id).then(result=> {
 
    })
};


const crearFilaAtributos = (attributes) => {
    const html = `
        <td scope="col"> ${attributes[0].value} </td>
        <td scope="col"> ${attributes[1].value} </td>
        <td scope="col"> ${attributes[2].value} </td>
        <td scope="col"> ${attributes[3].value} </td>
        <td scope="col"> ${attributes[4].value} </td>
    `;

    const tr = document.createElement('tr');
    tr.innerHTML = html;

    tBody.appendChild(tr);
}

const agregarDestino = () => {
    destinoP.innerHTML = `Tu destino: ${destino}`;
}

const agregarProtection = () => {
    protectionP.innerHTML = `Tu protección: ${protection}`;
    if (protection == 3) {
        protectionP.innerHTML = `Tu protector es el dios : ${protection}, Hades`;
    }else if(protection == 2){
        protectionP.innerHTML = `Tu protector es el dios : ${protection}, Poseidon`;
    }else if(protection == 1){
        protectionP.innerHTML = `Tu protector es el dios : ${protection}, Zeus`;
    }
   
}


 
