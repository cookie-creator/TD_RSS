import {createStore} from "vuex";

const store = createStore({
  state: {
    user: {
      data: {
        name: 'Tom Cook',
        email: 'tom@example.com',
        imageUrl:
          'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
      },
      // token: sessionStorage.getItem("TOKEN"),
      token: 111,
    },
    dashboard: {
      data: {},
      loading: false
    },
    app: {

    },
  },
  getters: {},
  actions: {
    register({commit}, user) {
      return axiosClient.post('/api/v1/auth/register', user)
        .then(({data}) => {
          commit('setUser', data.user);
          commit('setToken', data.token)
          return data;
        })
    },
    login({commit}, user) {
      return axiosClient.post('/api/v1/auth/login', user)
        .then(({data}) => {
          commit('setUser', data.user);
          commit('setToken', data.user.token)
          return data;
        })
    },
    logout({commit}) {
      return axiosClient.post('/api/v1/auth/logout')
        .then(response => {
          commit('logout')
          return response;
        })
    },

    /* User */
    getUser({commit}) {
      return axiosClient.get('/api/v1/auth/me')
        .then(res => {
          commit('setUser', res.data)
        })
    },
  },

  mutations: {
    logout: (state) => {
      state.user.token = null;
      state.user.data = {};
      sessionStorage.removeItem("TOKEN");
    },
    setUser: (state, user) => {
      state.user.data = user.user;
    },
    setToken: (state, token) => {
      state.user.token = token;
      sessionStorage.setItem('TOKEN', token);
    },
    dashboardLoading: (state, loading) => {
      state.dashboard.loading = loading;
    },
    setDashboardData: (state, data) => {
      state.dashboard.data = data
    },
  },
  modules: {}
});

export default store;
