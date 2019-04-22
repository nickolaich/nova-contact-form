import '@babel/polyfill'
import Vue from 'vue'
import App from './App.vue'
import store from './store/index'
import { i18n } from './plugins/i18n.js'
Vue.config.productionTip = false
new Vue({
  store,
  i18n,
  render: h => h(App)
}).$mount('#app')
