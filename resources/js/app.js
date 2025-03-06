import './bootstrap';
import 'admin-lte';

import 'admin-lte/dist/js/adminlte.min.js';
import 'admin-lte/plugins/jquery/jquery.min.js';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';

import 'select2';
import 'select2/dist/css/select2.css';

import flatpickr from 'flatpickr';
window.flatpickr = flatpickr;

tailwind.config = {
    prefix: 'tw-',
    corePlugins: {
      preflight: false,
    },
    important: true
}
