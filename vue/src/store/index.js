import axios from "axios";
import {createStore} from "vuex"
import axiosClient from "../axios"


const store = createStore(
  {
    state: {

      user: {
        data: {},
        token: localStorage.getItem('TOKEN')
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

      // criterias state
      criterias: {
        loading: false,
        links: [],
        data: []
      },

      // judges state
      judges: {
        loading: false,
        links: [],
        data: []
      },
      currentJudge: {
        data: {},
        loading: false,
      },

      // contestants state
      contestants: {
        loading: false,
        links: [],
        data: []
      },

      //score
      scores: {
        loading: false,
        links: [],
        data: []
      },
      currentScore: {
        data: {},
        loading: false,
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
      getContestsByEvent({ commit }, event_id) {
        commit('setContestsLoading', true)
        return axiosClient.get(`/contest-by-event?event_id=${event_id}`).then((res) => {
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
      getCriterias({ commit }, {url = null,id=null} = {}) {
      commit('setCriteriasLoading', true)
      url = url || "/criterias";
      if(id) {
        url = `/criterias?id=${id}`;
      }
      return axiosClient.get(url).then((res) => {
          commit('setCriteriasLoading', false)
          commit("setCriterias", res.data);
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
      updateCriteria({ commit, dispatch }, criteria) {

        let response;
        if (criteria.id) {
          response = axiosClient
            .put(`/criterias/${criteria.id}`, criteria)
            .then((res) => {
              return res;
            });
        }


        return response;
      },

      deleteCriteria({ dispatch }, id) {
        return axiosClient.delete(`/criterias/${id}`).then((res) => {
          dispatch('getCriterias')
          return res;
        });
      },

      // JUDGES
      getJudges({ commit }, {url = null,id=null} = {}) {
      commit('setJudgesLoading', true)
      url = url || "/judges";
      if(id) {
        url = `/judges?id=${id}`;
      }
      return axiosClient.get(url).then((res) => {
          commit('setJudgesLoading', false)
          commit("setJudges", res.data);
          return res;
        });
      },

      getJudge({ commit }, id) {
        commit("setCurrentJudgeLoading", true);
        return axiosClient
          .get(`/judges/${id}`)
          .then((res) => {
            console.log(res)
            commit("setCurrentJudge", res.data);
            commit("setCurrentJudgeLoading", false);
            return res;
          })
          .catch((err) => {
            commit("setCurrentJudgeLoading", false);
            throw err;
          });
      },

      saveJudges({ commit, dispatch }, judges) {
        let response;
          response = axiosClient.post("/judges", judges).then((res) => {
            return res;
          });
        return response;
      },
      updateJudge({ commit, dispatch }, judge) {

        let response;
        if (judge.id) {
          response = axiosClient
            .put(`/judges/${judge.id}`, judge)
            .then((res) => {
              return res;
            });
        }


        return response;
      },

      deleteJudge({ dispatch }, id) {
        return axiosClient.delete(`/judges/${id}`).then((res) => {
          dispatch('getJudges')
          return res;
        });
      },

      // CONTESTANTS
      getContestants({ commit }, {url = null,id=null} = {}) {
      commit('setContestantsLoading', true)
      url = url || "/contestants";
      if(id) {
        url = `/contestants?id=${id}`;
      }
      return axiosClient.get(url).then((res) => {
        console.log(res);
          commit('setContestantsLoading', false)
          commit("setContestants", res.data);
          return res;
        });
      },
      saveContestants({ commit, dispatch }, contestants) {
        let response;
          response = axiosClient.post("/contestants", contestants).then((res) => {
            return res;
          });
        return response;
      }

      ,
      updateContestant({ commit, dispatch }, contestant) {

        let response;
        if (contestant.id) {
          response = axiosClient
            .put(`/contestants/${contestant.id}`, contestant)
            .then((res) => {
              return res;
            });
        }


        return response;
      },

      deleteContestant({ dispatch }, id) {
        return axiosClient.delete(`/contestants/${id}`).then((res) => {
          console.log(res)
          dispatch('getContestants')
          return res;
        });
      },

      // SCORE

      getScore({ commit }, {judge_id = null,contestant_id=null}) {
        commit("setCurrentScoreLoading", true);
        return axiosClient
          .get(`/score-by-judge-contestant?judge_id=${judge_id}&contestant_id=${contestant_id}`)
          .then((res) => {
            console.log(res.data);
            commit("setCurrentScore", res.data);
            commit("setCurrentScoreLoading", false);
            return res;
          })
          .catch((err) => {
            commit("setCurrentScoreLoading", false);
            throw err;
          });
      },
      saveScore({ commit, dispatch }, score) {

        let response;
        if (score.id) {
          response = axiosClient
            .put(`/scores/${score.id}`, score)
            .then((res) => {
              commit('setCurrentScore', res.data)
              return res;
            });
        } else {
          response = axiosClient.post("/scores", score).then((res) => {
            commit('setCurrentScore', res.data)
            return res;
          });
        }

        return response;
      },

    },
    mutations: {

      logout: (state) => {
        state.user.token = null;
        state.user.data = {};
        localStorage.removeItem('TOKEN')
      },
      setUser: (state, user) => {
        state.user.data = user;
      },
      setToken: (state, token) => {
        state.user.token = token;
        localStorage.setItem('TOKEN', token);
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

      // SET CRITERIAS
      setCriteriasLoading: (state, loading) => {
        state.criterias.loading = loading;
      },
      setCriterias: (state, criterias) => {
        state.criterias.links = criterias.meta.links;
        state.criterias.data = criterias.data;
      },

      // SET JUDGES
      setJudgesLoading: (state, loading) => {
        state.judges.loading = loading;
      },
      setJudges: (state, judges) => {
        state.judges.links = judges.meta.links;
        state.judges.data = judges.data;
      },
      setCurrentJudgeLoading: (state, loading) => {
        state.currentJudge.loading = loading;
      },
      setCurrentJudge: (state, judge) => {
        state.currentJudge.data = judge.data;
      },

       // SET CONTESTANTS
      setContestantsLoading: (state, loading) => {
        state.contestants.loading = loading;
      },
      setContestants: (state, contestants) => {
        state.contestants.links = contestants.meta.links;
        state.contestants.data = contestants.data;
      },

      // SET SCORES
      setScoresLoading: (state, loading) => {
        state.scores.loading = loading;
      },
      setScores: (state, scores) => {
        // state.scores.links = scores.meta.links;
        state.scores.data = scores.data;
      },
       setCurrentScoreLoading: (state, loading) => {
        state.currentScore.loading = loading;
      },
      setCurrentScore: (state, score) => {
        state.currentScore.data = score.data;
      },


      // NOTIFICATION
      notify: (state, {message, type}) => {
        state.notification.show = true;
        state.notification.type = type;
        state.notification.message = message;
        setTimeout(() => {
          state.notification.show = false;
        }, 3500)
      },
    },
    modules: {}
  }
)

export default store;
