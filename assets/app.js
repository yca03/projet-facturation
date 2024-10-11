/* * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)
import './css/app.css';
import './js/dataTables.bootstrap';
import 'select2/dist/js/select2.min'
require('inputmask');
import './js/datatables-demo';
import './js/select2-demo';
import './js/add-form-collection'
import './js/delete.form.collection'
import './css/custom.min.css'
import './js/userNameAutomatique';


import {runInputmask} from "./js/inputMark";

require("datatables.net")
require("datatables.net-responsive")
// require('datatables.net-buttons')
require('datatables.net-buttons-bs4')()
require("datatables.net-buttons/js/buttons.html5")
require("datatables.net-buttons/js/buttons.colVis")
require("datatables.net-buttons/js/buttons.print")
require("datatables.net-rowgroup");
require("datatables.net-fixedheader");


/** Cutoms JS */
import './js/page/feature/facture/add-collection-detail-facture'
import './js/page/feature/facture/add-collection-detail-facture-pro'
import './js/page/feature/facture/add-collection-detailEncaissement'
import './js/page/feature/facture/add-collection-detailEncaissement-modePayement'

import './js/page/feature/encaissement/encaissement'
import './js/page/feature/encaissement/modePayement'

import './js/page/feature/Produit/add-collection-detail-produit'

const moment = require('moment')
global.moment = moment;


///require("datatables.net")

runInputmask();