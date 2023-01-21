// Import our custom CSS
import '../styles/styles.scss'

// Import all of Bootstrap JS
import * as bootstrap from 'bootstrap'

import {init} from './pruebas';
import {ListPrueba} from './classes/ListaPrueba'


init();
export let listPruebas = new ListPrueba();
