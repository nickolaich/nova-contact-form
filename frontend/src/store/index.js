import Vue from 'vue'
import Vuex from 'vuex'
import Mutations from './mutations'
import Actions from './actions'
import Getters from './getters'
import State from './state'

Vue.use(Vuex)

export default new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',

  namespaced: true,
  state: State,
  mutations: Mutations,
  actions: Actions,
  getters: Getters
})
