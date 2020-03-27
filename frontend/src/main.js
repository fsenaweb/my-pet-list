import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';

import router from './router';
import store from './store';
import App from './App.vue';

Vue.use(VueSweetalert2);

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app');
