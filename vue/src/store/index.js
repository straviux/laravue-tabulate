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
      news: []
    },
    getters: {},
    actions: {
      saveNews({commit},news){
        let response;
        if(news.id) {
          response = axiosClient.put(`/news/${news.id}`, news)
          .then((res)=>{
            commit("updateNews", res.data);
            return res;
          })
        } else {
          response = axiosClient.post("/news", news).then((res)=>{
            commit("saveNews", res.data);
            return res;
          })
        }
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
      saveNews: (state, news)=>{
        state.news = [...state.news, news.data];
      },
      updateNews: (state, news)=>{
        state.news = state.news.map((n)=>{
          if(n.id==news.data.id) {
            return news.data
          }
          return n;
        })
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
