// resources/js/bootstrap.js
import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Si más adelante necesitás Echo/Pusher, se agrega acá.
// Por ahora lo dejamos simple.
