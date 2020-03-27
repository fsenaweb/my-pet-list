import Vue from 'vue';
import Router from 'vue-router';
import Form from './components/Login/Form.vue';
import Painel from './components/Painel/Listagem.vue';
import { TOKEN_KEY } from './service/auth';

Vue.use(Router);

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'login',
      component: Form,
      meta: {
        guest: true,
      },
    },
    {
      path: '/painel',
      name: 'painel',
      component: Painel,
      meta: {
        requiresAuth: true,
      },
    },
  ],
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (localStorage.getItem(TOKEN_KEY) === null) {
      next({
        path: '/',
      });
    } else {
      next();
    }
  } else if (to.matched.some(record => record.meta.guest)) {
    if (localStorage.getItem(TOKEN_KEY) == null) {
      next();
    } else {
      next({ name: 'painel' });
    }
  } else {
    next();
  }
});

export default router;
