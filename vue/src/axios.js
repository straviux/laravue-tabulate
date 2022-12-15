import axios from "axios"
import store from "./store"

const axiosClient = axios.create({
  baseURL: 'http://192.168.1.37:8000/api'
  // baseURL: `${import.meta.env.VITE_API_BASE_URL}/api`
})


axiosClient.interceptors.request.use(config=> {
  config.headers.Authorization = `Bearer ${store.state.user.token}`;
  return config;
});

export default axiosClient;
