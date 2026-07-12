import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

import Intersect from '@alpinejs/intersect';

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.plugin(Intersect);

Alpine.start();