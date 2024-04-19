import api from '@/api';
import axios from 'axios';
import { RESPONSE_STATUS } from '@/constants';

const state = {
  token: '',
  tokenNeedsRefresh: false,
  tokenRefreshed: false,
  loginError: '',
  isAuthenticated: false,
  loggedOut: false,
  userName: '',
};

const getters = {
  token: (state) => {
    return state.token;
  },
  tokenNeedsRefresh: (state) => {
    return state.tokenNeedsRefresh;
  },
  tokenRefreshed: (state) => {
    return state.tokenRefreshed;
  },
  loginError: (state) => {
    return state.loginError;
  },
  isAuthenticated: (state) => {
    return state.isAuthenticated;
  },
  loggedOut: (state) => {
    return state.loggedOut;
  },
  userName: (state) => {
    return state.userName;
  },
};

const actions = {
  /**
   * Login
   * @param {commit} commit
   * @param {String} name Username
   * @param {String} password
   * @returns {Promise<void>}
   */
  async logIn({ commit }, { name, password }) {
    try {
      const response = await api
        .post(`/api/auth/login`, { name, password });
      commit('setToken', response.data.access_token);
      commit('setIsAuthenticated', true);
      commit('setUserName', name);
    } catch (error) {
      if (error.response.status === RESPONSE_STATUS.UNAUTHORIZED) {
        commit('setLoginError', "We couldn\'t verify your account details");
      } else {
        commit('setLoginError', 'Something went wrong, please refresh and try again');
      }
    }
  },
  /**
   * Refresh token (after aborting all requests)
   * @param {commit} commit
   * @returns {Promise<void>}
   */
  async refreshToken({ commit }) {
    try {
      // axios instead of api instance (controller.abort() executed)
      const response = await axios.post('/api/auth/refresh', {}, {
        headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
      });
      commit('setToken', response.data.access_token);
      commit('setTokenRefreshed', true);
    } catch (e) {
      console.log('Token refresh failed');
      console.log(e);
    }
  },
  /**
   * Logout
   * @param {commit} commit
   * @param {store} store
   * @returns {Promise<void>}
   */
  async logOut({ commit, store }) {
    try {
      await api.post('/api/auth/logout');
    } catch (e) {
      console.log('Logout request failed');
      console.log(e);
    }
    commit('deleteToken');
    commit('deleteUserName');
    commit('setIsAuthenticated', false);
    commit('setLoggedOut', true);
  },
};

const mutations = {
  setToken(state, token) {
    localStorage.setItem('token', token);
    state.token = token;
  },
  deleteToken(state) {
    localStorage.removeItem('token');
    state.token = '';
  },
  setTokenNeedsRefresh(state, tokenNeedsRefresh) {
    state.tokenNeedsRefresh = tokenNeedsRefresh;
  },
  setTokenRefreshed(state, tokenRefreshed) {
    state.tokenRefreshed = tokenRefreshed;
  },
  setLoginError(state, loginError) {
    state.loginError = loginError;
  },
  setIsAuthenticated(state, isAuthenticated) {
    state.isAuthenticated = isAuthenticated;
  },
  setLoggedOut(state, loggedOut) {
    state.loggedOut = loggedOut;
  },
  setUserName(state, userName) {
    localStorage.setItem('user', userName);
    state.userName = userName;
  },
  deleteUserName(state) {
    localStorage.removeItem('user');
    state.userName = '';
  },
};

export default {
  state, mutations, actions, getters
}