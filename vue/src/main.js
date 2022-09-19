import { createApp } from 'vue'
import store from './store'
import router from "./router";
import App from './App.vue'
import './index.css'
import mdiVue from 'mdi-vue/v3'
import * as mdijs from '@mdi/js'


createApp(App)
.use(store)
.use(router)
.use(mdiVue, {
  icons: mdijs
})
.mount('#app')
