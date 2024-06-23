import './assets/output.css'
import axios from "axios";
import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

const app = createApp(App)

//Axios Configuration
axios.defaults.baseURL = import.meta.env.VITE_APP_BASE_URL_ENDPOINT;
axios.defaults.headers.common['Content-Type'] = 'application/json';
axios.defaults.headers.common['Accept'] = 'application/json';

if(localStorage.getItem('access') !== null) {
    const oauth = JSON.parse(localStorage.getItem('access'));
    axios.defaults.headers.common['Authorization'] = `Bearer ${oauth.access_token}`;
}

app.use(createPinia())
app.use(router)

app.mount('#app')
