import './bootstrap'
import Vue from 'vue/dist/vue.esm.js'
import SideMenu from './components/SideMenu.vue'
import PostLike from './components/PostLike.vue'
import CommonModal from './components/CommonModal.vue'
import PostEditMenu from './components/PostEditMenu.vue'
import Comment from './components/Comment.vue'
import SubComment from './components/SubComment.vue'

const app = new Vue({
    el: '#app',
    components: {
      SideMenu,
      PostLike,
      CommonModal,
      PostEditMenu,
      Comment,
      SubComment,
    }
  })