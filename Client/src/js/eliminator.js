import { deleteUser } from "./http-provider";


const close = document.getElementsByClassName('close')[0];
const form = document.getElementsByTagName('form')[0];
const id = document.querySelector('.id');
const modal= document.getElementById('modal');
const parrafo = document.getElementById('parrafo');

export const initDelete = () => {
    deleteHuman();
}

const deleteHuman = () => {
    
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        deleteUser(id.value)
            .then((data) => {
                console.log(data);
                const modal = document.getElementById('modalRegistro');
                const parrafo = document.getElementById('parrafo');
                document.getElementsByTagName('form')[0].reset();
                 
                if(data.success === true){
                parrafo.innerHTML = 'Usuario eliminado correctamente';
                modal.style.display = 'block';
                close.addEventListener('click', (event) => {
                    modal.style.display = "none";
                }) 
                }else{
                    parrafo.innerHTML = 'Ha ocurrido un error';
                    modal.style.display = 'block';
                    close.addEventListener('click', (event) => {
                        modal.style.display = "none";
                    })
                }
            })

            .catch((err) => {
                console.log(err);
                
            });
    });
}


 
       
// Path: src\js\eliminator.js