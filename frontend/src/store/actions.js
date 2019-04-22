// Root actions
import axios from 'axios'

const baseUrl = process.env.VUE_APP_API_URL
export default {
  increment ({commit}) {
    commit('INCREMENT')
  },

  submitContactForm ({}, payload) {
    return axios
      .post(baseUrl + '/contact', payload)
      .then(response => {
        return response
      })
  }

}
