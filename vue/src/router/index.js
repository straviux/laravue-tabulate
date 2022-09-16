import {createRouter, createWebHistory} from "vue-router";
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import DefaultLayout from "../components/DefaultLayout.vue";
import AuthLayout from "../components/AuthLayout.vue";
import Dashboard from "../views/Dashboard.vue";
import NotFound from "../views/NotFound.vue";
import store from "../store";


const routes = [
  // Public links
  {
    path: '/',
    redirect: '/dashboard',
    meta: { requiresAuth: true },
    name:  'Dashboard',
    component: DefaultLayout,
    children: [
      {path: '/dashboard', name: 'Dashboard', component: Dashboard},
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
  // {
  //   path: '/admin',
  //   redirect: '/admin/dashboard',
  //   name:  'AdminPanel',
  //   component: AdminDefaultLayout,
  //   meta: { requiresAuth: true },
  //   children: [
  //     {path: '/admin/dashboard', name: 'Dashboard', component: Dashboard},
  //     {path: '/admin/profile', name: 'Profile', component: Profile},
  //     {path: '/admin/news', name: 'NewsMaintenance', component: NewsMaintenance,redirect: '/admin/news/view',
  //         children:[
  //           {path: '/admin/news/view', name: 'NewsList', component:  NewsList},
  //           {path: '/admin/news/create', name: 'WriteNews', component:  NewsForm},
  //           {path: '/admin/news/:id', name: 'ViewNews',  component:  NewsForm},
  //         ]
  //     },
  //     {path: '/admin/articles', name: 'ArticlesMaintenance', component: ArticlesMaintenance},
  //     {path: '/admin/gallery', name: 'GalleryMaintenance', component: GalleryMaintenance},
  //   ]
  // },
  {path: '/:pathMatch(.*)*',redirect:'/404', component: NotFound},
  {
    path: '/404',
    name: 'NotFound',
    component: NotFound
  }
];

const router = createRouter( {
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({ name: "Login" });
  } else if (store.state.user.token && to.meta.isGuest) {
    next({ name: "Dashboard" });
  } else {
    next();
  }
});

export default router;
