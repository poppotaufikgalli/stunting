import './bootstrap';
import '../scss/styles.scss'
import * as bootstrap from 'bootstrap'
import jszip from 'jszip';
import pdfmake from 'pdfmake';
import DataTable from 'datatables.net-bs5';
import DateTime from 'datatables.net-datetime';
import 'datatables.net-responsive-bs5';

import feather from 'feather-icons';

//import * as L from 'leaflet';

(function () {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })
  
  window.DataTable = DataTable;
  window.bootstrap = bootstrap
})()