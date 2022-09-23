import { createApp } from 'vue'
import store from './store'
import router from "./router";
import App from './App.vue'
import './index.css'
import mdiVue from 'mdi-vue/v3'
import * as mdijs from '@mdi/js'
import moment from "moment";

const app = createApp(App);
app
.use(store)
.use(router)
.use(mdiVue, {
  icons: mdijs
})
.mount('#app');

app.config.globalProperties.$filters = {
  moment(dt,format) {
    return moment(dt).format(format);
  },

  numericOnly :(evt) => {
  const keysAllowed = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
  const keyPressed = evt.key;
  if (!keysAllowed.includes(keyPressed)) {
    evt.preventDefault();
  }
}

}


