import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/Home/HomeView.vue'
import Login from '../views/LoginView.vue'
import IndexView from '../views/IndexView.vue'
import EditView from '../views/Home/EditView.vue'
import LogView from '../views/Audit/IndexView.vue'
import RegisterView from '../views/RegisterView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: Login
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView
    },
  {
      path: '/admin',
      name:'admin',
      component: IndexView,
      children:[
          {
              path: 'home',
              name: 'admin.home',
              component: HomeView,
          },
          {
              path: 'log',
              name: 'admin.log',
              component: LogView,
          },
          {
              path: 'edit',
              name: 'admin.edit',
              component: EditView,
          },
      ]
  },
  ]
})

// GOOD
router.beforeEach((to, from, next) => {
    let test = localStorage.getItem('access') === null ? false : true
    if (to.name !== 'login' && !test) next({ name: 'login' })
    else next()
})

export default router
