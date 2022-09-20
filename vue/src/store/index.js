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
      dashboard: {
      loading: false,
      data: {}
      },

      // events state
      events: {
        loading: false,
        links: [],
        data: []
      },
      currentEvent: {
        data: {},
        loading: false,
      },

      // contests state
      contests: {
        loading: false,
        links: [],
        data: []
      },
      currentContest: {
        data: {},
        loading: false,
      },

      // contests
      criterias: {
        loading: false,
        links: [],
        data: []
      },
      notification: {
        show: false,
        type: 'success',
        message: ''
      }

    },
    getters: {},
    actions: {
      getUser({commit}) {
        return axiosClient.get('/user')
          .then(res => {
            // console.log(res);
            commit('setUser', res.data)
          })
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
          commit('setUser', data.user);
          commit('setToken', data.token)
          return data;
        })
      },
      logout({commit}) {
        return axiosClient.post('/logout')
          .then(response=>{
            commit('logout');
            return response;
          })
      },

      getEvents({ commit }, {url = null} = {}) {
      commit('setEventsLoading', true)
      url = url || "/events";
      return axiosClient.get(url).then((res) => {
          commit('setEventsLoading', false)
          commit("setEvents", res.data);
          // console.log(res.data);
          return res;
        });
      },
      getEvent({ commit }, id) {
        commit("setCurrentEventLoading", true);
        return axiosClient
          .get(`/events/${id}`)
          .then((res) => {
            commit("setCurrentEvent", res.data);
            commit("setCurrentEventLoading", false);
            return res;
          })
          .catch((err) => {
            commit("setCurrentEventLoading", false);
            throw err;
          });
      },
      saveEvent({ commit, dispatch }, event) {

      // delete event.image_url;

      let response;
      if (event.id) {
        response = axiosClient
          .put(`/events/${event.id}`, event)
          .then((res) => {
            commit('setCurrentEvent', res.data)
            return res;
          });
      } else {
        response = axiosClient.post("/events", event).then((res) => {
          commit('setCurrentEvent', res.data)
          return res;
        });
      }

      return response;
      },
      deleteEvent({ dispatch }, id) {
        return axiosClient.delete(`/events/${id}`).then((res) => {
          dispatch('getEvents')
          return res;
        });
      },

    // CONTESTS
      getContests({ commit }, {url = null} = {}) {
        commit('setContestsLoading', true)
        url = url || "/contests";
        return axiosClient.get(url).then((res) => {
            commit('setContestsLoading', false)
            commit("setContests", res.data);
            console.log(res.data);
            return res;
          });
        },
      getContest({ commit }, id) {
        commit("setCurrentContestLoading", true);
        return axiosClient
          .get(`/contests/${id}`)
          .then((res) => {
            commit("setCurrentContest", res.data);
            commit("setCurrentContestLoading", false);
            return res;
          })
          .catch((err) => {
            commit("setCurrentContestLoading", false);
            throw err;
          });
      },
      saveContest({ commit, dispatch }, contest) {

        let response;
        if (contest.id) {
          response = axiosClient
            .put(`/contests/${contest.id}`, contest)
            .then((res) => {
              commit('setCurrentContest', res.data)
              return res;
            });
        } else {
          response = axiosClient.post("/contests", contest).then((res) => {
            commit('setCurrentContest', res.data)
            return res;
          });
        }

        return response;
      },
      deleteContest({ dispatch }, id) {
        return axiosClient.delete(`/contests/${id}`).then((res) => {
          dispatch('getContests')
          return res;
        });
      },

      // CRITERIAS
      getCriterias({ commit }, {url = null} = {}) {
      commit('setCriteriasLoading', true)
      url = url || "/criterias";
      return axiosClient.get(url).then((res) => {
          commit('setCriteriasLoading', false)
          commit("setCriterias", res.data);
          // console.log(res.data);
          return res;
        });
      },
      saveCriterias({ commit, dispatch }, criterias) {
        let response;
          response = axiosClient.post("/criterias", criterias).then((res) => {
            return res;
          });
        return response;
      },

    },
    mutations: {

      logout: (state) => {
        state.user.token = null;
        state.user.data = {};
        sessionStorage.removeItem('TOKEN')
      },
      setUser: (state, user) => {
        state.user.data = user;
      },
      setToken: (state, token) => {
        state.user.token = token;
        sessionStorage.setItem('TOKEN', token);
      },

      // SET EVENTS
      setEventsLoading: (state, loading) => {
        state.events.loading = loading;
      },
      setEvents: (state, events) => {
        state.events.links = events.meta.links;
        state.events.data = events.data;
      },
      setCurrentEventLoading: (state, loading) => {
        state.currentEvent.loading = loading;
      },
      setCurrentEvent: (state, event) => {
        state.currentEvent.data = event.data;
      },

      // SET CONTEST
      setContestsLoading: (state, loading) => {
        state.contests.loading = loading;
      },
      setContests: (state, contests) => {
        state.contests.links = contests.meta.links;
        state.contests.data = contests.data;
      },
      setCurrentContestLoading: (state, loading) => {
        state.currentContest.loading = loading;
      },
      setCurrentContest: (state, contest) => {
        state.currentContest.data = contest.data;
      },
      notify: (state, {message, type}) => {
        state.notification.show = true;
        state.notification.type = type;
        state.notification.message = message;
        setTimeout(() => {
          state.notification.show = false;
        }, 3000)
      },
    },
    modules: {}
  }
)

export default store;
