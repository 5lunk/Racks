import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import axios from 'axios';
import './assets/tailwind.css';
import { RESPONSE_STATUS } from '@/constants';

axios.defaults.baseURL = process.env.VUE_APP_AXIOS_URL;

//Catch expired token
axios.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    if (error.response) {
      switch (error.response.status) {
        case RESPONSE_STATUS.UNAUTHORIZED:
          if (window.location.href.split('/').slice(-1)[0] === 'login') {
            return Promise.reject(error);
          }
          localStorage.removeItem('token');
          router.push('/login');
          window.location.reload();
      }
      return Promise.reject(error);
    }
  },
);

createApp(App).use(store).use(router, axios).mount('#app');
