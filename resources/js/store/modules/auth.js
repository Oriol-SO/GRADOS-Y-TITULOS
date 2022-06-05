import axios from 'axios'
import Cookies from 'js-cookie'
import { EventDispatcher } from 'tinymce'
import * as types from '../mutation-types'

// state
export const state = {
  user: null,
  token: Cookies.get('token'),
  currentRolid: null,
}
function getFirstRoute(rol_id) {
  let path = 'secretaria_general.dashboard';
  switch (rol_id) {
    case 10:
      path = 'alumno.dashboard'
      break;
    case 13:
      path = 'admin.dashboard'
      break;
  }
  console.log(rol_id)
  return path
}
// getters
export const getters = {
  user: state => state.user,
  token: state => state.token,
  check: state => state.user !== null,
  firstRoute: state=>getFirstRoute(state.currentRolid.id),
  currentRolid:state=>state.currentRolid,
}

// mutations
export const mutations = {
  [types.SAVE_TOKEN] (state, { token, remember }) {
    state.token = token
    Cookies.set('token', token, { expires: remember ? 365 : null })
  },

  [types.FETCH_USER_SUCCESS] (state, { user,currentRolid }) {
     state.user = user
   // if(!Cookies.get('currentRolid')){
      state.currentRolid=currentRolid
      console.log(currentRolid)
      Cookies.set('currentRolid', user.role)  //lioos
    //}//si es que existen current rol id

    //state.firsRoute=getFirstRoute(user.role)

    },

  [types.FETCH_USER_FAILURE] (state) {
    state.token = null
    Cookies.remove('token')
    Cookies.remove('currentRolid')
  },

  [types.LOGOUT] (state) {
    state.user = null
    state.token = null

    Cookies.remove('token')
  },

  [types.UPDATE_USER] (state, { user }) {
    state.user = user
  }
}

// actions
export const actions = {
  saveToken ({ commit, dispatch }, payload) {
    commit(types.SAVE_TOKEN, payload)
  },

  async fetchUser ({ commit }) {
    try {
      const { data } = await axios.get('/api/user')

      commit(types.FETCH_USER_SUCCESS, { user: data  ,currentRolid:{id:data.role[0]}})
    } catch (e) {
      commit(types.FETCH_USER_FAILURE)
    }
  },

  updateUser ({ commit }, payload) {
    commit(types.UPDATE_USER, payload)
  },

  async logout ({ commit }) {
    try {
      await axios.post('/api/logout')
    } catch (e) { }

    commit(types.LOGOUT)
  },

  async fetchOauthUrl (ctx, { provider }) {
    const { data } = await axios.post(`/api/oauth/${provider}`)

    return data.url
  }
}
