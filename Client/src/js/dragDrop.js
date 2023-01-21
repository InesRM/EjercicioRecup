export const addEventosDrop = (elemento) => {
        elemento.addEventListener('dragenter', dragEnter)
        elemento.addEventListener('dragover', dragOver);
        elemento.addEventListener('dragleave', dragLeave);
        elemento.addEventListener('drop', drop);
}

export const drag = (item) =>{
    item.addEventListener('dragstart', (e) => { 
        e.dataTransfer.setData('text/plain', e.target.id);
    });
}

function dragEnter(e) {
    e.preventDefault();
}

function dragOver(e) {
    e.preventDefault();
}

function dragLeave(e) {
}

function drop(e) {
    const id = e.dataTransfer.getData('text/plain');
    e.target.appendChild(document.getElementById(id));
}