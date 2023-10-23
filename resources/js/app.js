import './bootstrap';

// choices.js
import Choices from 'choices.js';
window.Choices = Choices;
import 'choices.js/public/assets/styles/choices.min.css';

// Flatpickr
import flatpickr from 'flatpickr';
window.flatpickr = flatpickr;
import { Danish } from 'flatpickr/dist/l10n/da.js';
// if(Sequii.locale == 'da') {
//     flatpickr.localize(Danish);
// }
import 'flatpickr/dist/flatpickr.min.css';

import * as FilePond from 'filepond';
window.FilePond = FilePond;
import 'filepond/dist/filepond.min.css';
