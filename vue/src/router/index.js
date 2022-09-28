import {createRouter, createWebHistory} from "vue-router";
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import DefaultLayout from "../components/DefaultLayout.vue";
import AuthLayout from "../components/AuthLayout.vue";
import Dashboard from "../views/Dashboard.vue";
import NotFound from "../views/NotFound.vue";
import store from "../store";
import Event from "../views/Event.vue";
import EventForm from "../components/event/EventForm.vue";
import Contest from "../views/Contest.vue";
import ContestForm from "../components/contest/ContestForm.vue";
import Tabulate from "../views/Tabulate.vue";
import Scoresheet from "../components/tabulate/Scoresheet.vue";
import FinalResult from "../views/FinalResult.vue";
const routes = [
  // Public links
  {
    path: '/',
    redirect: '/admin/dashboard',
    meta: { requiresAuth: true },
    name:  'Admin',
    component: DefaultLayout,
    children: [
      {path: '/admin/dashboard', name: 'Dashboard', component: Dashboard},
      {path: '/admin/users', name: 'Users', component: Dashboard},
      // EVENTS ROUTE
      {path: '/admin/event', name: 'Events', component: Event},
      {path: '/admin/event/create', name: 'AddEvent', component: EventForm},
      {path: '/admin/event/:id', name: 'EventView', component: EventForm},
      // END EVENTS ROUTE

      // CONTEST ROUTE
      {path: '/admin/contest', name: 'Contest', component: Contest},
      {path: '/admin/contest/create', name: 'AddContest', component: ContestForm},
      {path: '/admin/contest/:id', name: 'ContestView', component: ContestForm},

      // SCORING ROUTE
      {path: '/admin/tabulate', name: 'Tabulate', component: Tabulate, children:[
        {
          path: 'scoresheet/:contest_id/:judge_id',name: 'ScoresheetForm', component: Scoresheet
        }
      ]},

      {path: '/admin/finalresult', name: 'FinalResult', component: FinalResult},

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
  },
];

const router = createRouter( {
  // history: createWebHistory('/web'),
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
