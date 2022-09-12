import {createRouter, createWebHistory} from "vue-router";
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Home from "../views/Home.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import News from "../views/Public/News.vue";
import Articles from "../views/Public/Articles.vue";
import Gallery from "../views/Public/Gallery.vue";
import AuthLayout from "../components/AuthLayout.vue";
import AdminDefaultLayout from "../components/admin/DefaultLayout.vue"
import Dashboard from "../views/Admin/Dashboard.vue"
import Profile from "../views/Admin/Profile.vue"
import NewsMaintenance from "../views/Admin/News.vue"
import ArticlesMaintenance from "../views/Admin/Articles.vue"
import GalleryMaintenance from "../views/Admin/Gallery.vue"
import store from "../store";


const routes = [
  // Public links
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

  // Authorization
  {
    path: "/auth",
    redirect: "/login",
    name: "Auth",
    component: AuthLayout,
    meta: {isGuest: true},
    children: [
      {
        path: "/login",
        name: "Login",
        component: Login,
      },
      {
        path: "/register",
        name: "Register",
        component: Register,
      },
    ],
  },

  // Admin Panel
  {
    path: '/admin',
    redirect: '/admin/dashboard',
    name:  'AdminPanel',
    component: AdminDefaultLayout,
    meta: { requiresAuth: true },
    children: [
      {path: '/admin/dashboard', name: 'Dashboard', component: Dashboard},
      {path: '/admin/profile', name: 'Profile', component: Profile},
      {path: '/admin/news', name: 'NewsMaintenance', component: NewsMaintenance},
      {path: '/admin/articles', name: 'ArticlesMaintenance', component: ArticlesMaintenance},
      {path: '/admin/gallery', name: 'GalleryMaintenance', component: GalleryMaintenance},
    ]
  },
];

const router = createRouter( {
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({ name: "Login" });
  } else if (store.state.user.token && to.meta.isGuest) {
    next({ name: "AdminPanel" });
  } else {
    next();
  }
});

export default router;
