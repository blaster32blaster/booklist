import Vue from 'vue';
import Vuex from 'vuex';
import comics from  './modules/comic';
Vue.use(Vuex)
const debug = process.env.NODE_ENV !== 'production'
export default new Vuex.Store({
  modules: {
    comics
  },
  strict: debug
})
