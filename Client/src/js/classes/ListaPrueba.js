export class ListPrueba{
    constructor() {
        this.prueba = [];
    }

    getListaPrueba(){
        return this.prueba;
    }

    nuevaPrueba(prueba) {
        this.prueba.push(prueba);
    }

    eliminarPrueba(id) {
        this.prueba = this.prueba.filter(prueb => prueb.id != id);       
    }

    getPrueba(id){
        let p = [];
        for( const prueba of this.prueba ){
            if (prueba.id == id) {
                p = prueba;
            }
        }
        return p;
    }    
}