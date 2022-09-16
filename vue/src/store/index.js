import axios from "axios";
import {createStore} from "vuex"
import axiosClient from "../axios"


const store = createStore(
  {
    state: {
      user: {
        data: {},
        token: sessionStorage.getItem('TOKEN')
      },
      news: [],
      currentNews: {
        loading: false,
        data: {}
      }
    },
    getters: {},
    actions: {
      getNews({commit}, id) {
        commit("setCurrentNewsLoading", true);
        return axiosClient
        .get(`/news/${id}`)
        .then((res)=>{
          commit("setCurrentNews",res.data);
          commit("setCurrentNewsLoading", false);
          console.log(res.data)
          return res;
        })
        .catch((err)=>{
          commit("setCurrentNewsLoading", false);
          throw err;
        })
      },
      saveNews({commit},news){
        delete news.cover_photo_url;
        let response;
        if(news.id) {
          response = axiosClient.put(`/news/${news.id}`, news)
          .then((res)=>{
            commit("setCurrentNews", res.data);
            return res;
          })
        } else {
          response = axiosClient.post("/news", news).then((res)=>{
            commit("setCurrentNews", res.data);
            return res;
          })
        }
        return response;
      },
      register({commit}, user) {
        return axiosClient.post('/register', user)
        .then(({data})=> {
          commit('setUser',data);
          return data;
        })
      },
      login({commit}, user) {
        return axiosClient.post('/login', user)
        .then(({data})=> {
          commit('setUser',data);
          return data;
        })
      },
      logout({commit}) {
        return axiosClient.post('/logout')
          .then(response=>{
            commit('logout');
            return response;
          })
      }

    },
    mutations: {
      setCurrentNewsLoading: (state, loading) => {
        state.currentNews.loading = loading;
      },
      setCurrentNews: (state, news)=>{
        state.currentNews.data = news.data;
      },

      logout: (state) => {
        state.user.token = null;
        state.user.data = {};
        sessionStorage.removeItem('TOKEN')
      },
      setUser: (state, userData) => {
        state.user.token = userData.token;
        state.user.data = userData.user;
        sessionStorage.setItem('TOKEN', userData.token)
      }
    },
    modules: {}
  }
)

export default store;
