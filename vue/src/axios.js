import axios from "axios"
import store from "./store"

const axiosClient = axios.create({
  // baseURL: 'http://192.168.0.170:8000/api'
  baseURL: 'http://localhost:8000/api'
})


axiosClient.interceptors.request.use(config=> {
  config.headers.Authorization = `Bearer ${store.state.user.token}`;
  return config;
});

export default axiosClient;
