import {createRouter, createWebHistory} from "vue-router";
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Home from "../views/Home.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import News from "../views/Public/News.vue";
import Articles from "../views/Public/Articles.vue";
import Gallery from "../views/Public/Gallery.vue";

const routes = [
  {
    path: '/',
    redirect: '/home',
    name:  'Home',
    component: DefaultLayout,
    children: [
      {path: '/home', name: 'Home', component: Home},
      {path: '/news', name: 'News', component: News},
      {path: '/articles', name: 'Articles', component: Articles},
      {path: '/gallery', name: 'Gallery', component: Gallery}
    ]
  },
  {
    path: '/login',
    name:  'Login',
    component: Login
  },
  {
    path: '/register',
    name:  'Register',
    component: Register
  },
];

const router = createRouter( {
  history: createWebHistory(),
  routes
})

export default router;
