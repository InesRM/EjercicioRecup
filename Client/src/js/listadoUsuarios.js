// Import our custom CSS
import '../styles/styles.scss'

// Import all of Bootstrap JS
import * as bootstrap from 'bootstrap'
import { inicio } from '../js/listaUsuarios-html';
import {ListUsuario} from './classes/ListaUsuario'

inicio();
export let listUsuarios = new ListUsuario();