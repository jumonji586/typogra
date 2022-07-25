import './bootstrap'
import Vue from 'vue/dist/vue.esm.js'
import SideMenu from './components/SideMenu.vue'

const app = new Vue({
    el: '#app',
    components: {
      SideMenu,
    }
  })