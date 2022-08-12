<template>
  <div class="post-edit-menu-box" :class="{active:Active}">
    <a class="post-edit-btn" @click="Active = !Active" 
      ><img class="icon wid100" src="/img/icon/icon-menu.png" alt=""
    /></a>
    <div v-if="btntype === 'illust'" class="post-edit-menu" :class="{active:Active}">
      <a v-if="userflag || role" @click="Open = true"><img class="icon" src="/img/icon/icon-delete.png">投稿を削除する</a>
      <a v-if="!userflag" :href="endpointViolation" target="_blank"><img class="icon" src="/img/icon/icon-violation.png">違反報告する</a>
      <a v-if="!recommendflag && role" @click="recommendOn"><img class="icon" src="/img/icon/icon-recommend.png">おススメに登録</a>
      <a v-if="recommendflag && role" @click="recommendOff"><img class="icon" src="/img/icon/icon-recommend.png">おススメを解除</a>
    </div>
    <div v-if="btntype === 'comment'||btntype === 'comment2'" class="post-edit-menu" :class="{active:Active}">
      <a v-if="userflag || role" @click="Open = true"><img class="icon" src="/img/icon/icon-delete.png">削除する</a>
      <a v-if="!userflag" :href="endpointViolation + '?message=' + comment" target="_blank"><img class="icon" src="/img/icon/icon-violation.png">違反報告する</a>
    </div>
    <div class="post-edit-modal" :class="{modalopen:Open}">
      <div class="post-edit-modal-bg" @click="Open = false"></div>
      <div class="post-edit-message-box">
          <form method="POST" :action="endpointDelete">
            <slot></slot>
            <p v-if="btntype === 'illust'">
              この投稿を削除します。よろしいですか？
            </p>
            <p v-if="btntype === 'comment'||btntype === 'comment2'">
              このコメントを削除します。よろしいですか？
            </p>
            <div class="btn-box">
              <a class="cancel-btn" @click="Open = false">キャンセル</a>
              <input v-if="btntype === 'illust'" class="enter-btn" type="submit" value="削除">
              <a v-if="btntype === 'comment'" class="enter-btn" @click="$emit('deleteComment',commeid); Open = false" >削除</a>
              <a v-if="btntype === 'comment2'" class="enter-btn" @click="$emit('deleteSubComment',commeid); Open = false" >削除</a>
            </div>
          </form>
        </div>
    </div>
  </div>
</template>
<script>
export default {
  props:{
    endpointDelete:{
      type:String,
    },
    endpointRecommend:{
      type:String,
    },
    endpointViolation:{
      type:String,
    },
    btntype:{
      type:String,
    },
    comment:{
      type:String,
    },
    commeid:{
      type:Number,
    },
    role: {
      type: Boolean,
      default: false,
    },
    userflag: {
      type: Boolean,
      default: false,
    },
    initialRecommendflag: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      Active: false,
      Open:false,
      recommendflag:this.initialRecommendflag,
      // 直接propsいじるとwarning出るのでdataに代入してる
    };
  },
  mounted() {
    document.addEventListener("click", (e) => {
      if (!e.target.closest(".post-edit-btn")) {
        this.Active = false;
      }
    });
  },
  methods:{
      async recommendOn() {
        await axios.put(this.endpointRecommend)
        this.recommendflag = true
      },
      async recommendOff() {
        await axios.delete(this.endpointRecommend)
        this.recommendflag = false
      },
  },
};
</script>

<!--<style>-->
<style scoped>
.post-edit-menu-box {
  width: 30px;
  height: 30px;
  position: relative;
  padding:3px;
  border-radius: 50%;
  margin-left: 8px;
  transition: all 0.2s;
  background-color: #6B7B86;

}
.post-edit-menu-box.active{
  background-color: #515C63;
}
.post-edit-menu {
  position: absolute;
  width: 150px;
  z-index:25;
  background-color: #FFE819;
  background-color: #fff;
  background-color: #515C63;
  right: 0;
  bottom: -15px;
  right: 0px;
  transform: translate(0,100%)scale(0.01);
  /* padding-bottom:15px ; */
  box-shadow: rgba(0, 0, 0,0.1) 0 0 5px;
  transition: all 0.1s;
  transform-origin: top right;
  visibility: hidden;
  padding: 0 15px;
}
.post-edit-menu.active{
  visibility: visible;
  transform: translate(0,100%)scale(1);
}
.post-edit-menu a{
  display:flex;
  align-items: center;
  /* padding: 15px 15px 0 15px; */
  padding: 15px 0;
  border-top: 1px solid #d4d4d4;
}
.post-edit-menu a:first-of-type{
  border-top: none;
}
.post-edit-menu a img{
  height: 18px;
  margin-right: 5px;
}
.post-edit-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  z-index: 30;
  display: flex;
  visibility: hidden;
  opacity: 0;
  transition: all 0.15s;
  padding: 100px 0;
}
.post-edit-modal.modalopen{
  opacity: 1;
  visibility: visible;
}
.post-edit-modal-bg{
  position: absolute;
  top:0;
  left:0;
  background-color: rgba(0, 0, 0, 0.85);
  height: 100%;
  width: 100%;
  /* opacity: 0;
  visibility: hidden; */
}

.post-edit-message-box{
  position: relative;
  background-color: #606E78;
  margin:auto;
  padding:50px;
  transform: scale(0.01);
  transition: transform 0.15s;
}
.post-edit-modal.modalopen .post-edit-message-box{
  transform: scale(1);
}
.post-edit-message-box .btn-box{
    margin-top:20px;
    display: flex;
    justify-content: space-between;
    width: 100%;
}
.post-edit-message-box .cancel-btn,.post-edit-message-box .enter-btn{
    width: 47%;
    border: none;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 600;
    padding:10px 7px;
    /* background-color: #fff; */
    background-color: #DFE2E4;
    color: #000;
}
/* .post-edit-message-box .enter-btn{
    background-color: #FFE819;
} */
</style>
