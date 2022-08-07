<template>
  <div>
    <div class="common-modal-btn" @click="Open = true"></div>
    <div class="common-modal" @click="Open = false" :class="{modalopen:Open}">
      <slot></slot>
      <div class="close-mark">×</div>
    </div>
  </div>
</template>
<script>
export default {
  data(){
    return{
      Open:false,
    };
  },
  // methods: {
  //   modalOpen() {
  //     this.$refs.modal.style="visibility:visible;opacity:1";
  //   },modalClose(){
  //     this.$refs.modal.style="visibility:hidden";
  //     this.$refs.modal.style="opacity:0";
  //   }
  // },
};
</script>

<style scoped>
/* .article-list .common-modal-btn{
  display: none;
} */
.common-modal{
  position: fixed;
  top:0;
  left:0;
  width: 100%;
  height: 100vh;
  overflow: scroll;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 30;
  display: flex;
  visibility:hidden;
  opacity:0;
  transition:all 0.15s;
  padding:100px 0;
  -ms-overflow-style: none;    /* IE, Edge 対応 */
  scrollbar-width: none;  /* firefox 対応 */
}
.common-modal::-webkit-scrollbar{
  display: none;
}
.common-modal.modalopen{
  visibility: visible;
  opacity: 1;
}
.common-modal>*{
  vertical-align: top;
  /* width: auto; */
  max-width: 100%;
  margin:auto;
  transform: scale(0.01);
  transition: transform 0.15s;
}
.common-modal.modalopen >*{
  transform: scale(1);
}
.common-modal-btn{
  position: absolute;
  display: block;
  left:0;
  top:0;
  width: 100%;
  height: 100%;
  /* z-index: 20; */
  cursor: pointer;
}
.common-modal .close-mark{
  position: absolute;
  font-size: 45px;
  top:15px;
  right:15px;
  line-height: 1;
  color: #fff;
  cursor: pointer;
}


</style>
