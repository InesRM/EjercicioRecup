export class ListUsuario{
    constructor() {
        this.usuario = [];
    }

    getListaUsuario(){
        return this.usuario;
    }

    nuevoUsuario(usuario) {
        this.usuario.push(usuario);
    }

    eliminarUsuario(id) {
        this.usuario = this.usuario.filter(user => user.id != id);       
    }

    getUsuario(id){
        let u = [];
        for( const usuario of this.usuario ){
            if (usuario.id == id) {
                u = usuario;
            }
        }
        return u;
    }  
    
    getHumanos(){
        return this.usuario.filter(user => user.rol == 'human');     
    }
}