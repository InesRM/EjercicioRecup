import { logOut } from "./http-provider"

export const inicializar = () =>{
    logOutFunc();
}

const logOutFunc = () => {
    document.getElementById("logOut").addEventListener("click", () => {
        const data = JSON.parse(localStorage.getItem('user'));
        logOut(data).then(result => {
            if (result.success === true){
                window.localStorage.removeItem('user');
                window.location.href = "../index.html";
            } 
        });
    })
}