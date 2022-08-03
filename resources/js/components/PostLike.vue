<template>
  <div class="like-btn-box">
    <a class="heart-mark-box" @click="clickLike" :class="{'active-heart':this.isLikedBy, 'heart-anime':this.gotToLike}">
      <img class="heart-mark-white icon" src="/img/icon/icon-heart-white.png" alt="">
      <img class="heart-mark-red icon" src="/img/icon/icon-heart-red.png" alt="">
    </a>
    <span class="like-count">{{ countLikes }}</span>
  </div>
</template>

<script>
  export default {
    props: {
      initialIsLikedBy: {
        type: Boolean,
        default: false,
      },
      initialCountLikes: {
        type: Number,
        default: 0,
      },
      authorized: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
    },
    data() {
      return {
        isLikedBy: this.initialIsLikedBy,
        countLikes: this.initialCountLikes,
        gotToLike: false, 
      }
    },
    methods: {
      clickLike() {
        if (!this.authorized) {
          alert('いいね機能はログイン中のみ使用できます')
          return
        }

        this.isLikedBy
          ? this.unlike()
          : this.like()
      },
      async like() {
        const response = await axios.put(this.endpoint)

        this.isLikedBy = true
        this.countLikes = response.data.countLikes
        this.gotToLike = true 
      },
      async unlike() {
        const response = await axios.delete(this.endpoint)

        this.isLikedBy = false
        this.countLikes = response.data.countLikes
        this.gotToLike = false 
      },
    },
  }
</script>

<style scoped>
.like-btn-box{
    display: flex;
    align-items: flex-end;
    /* height: 100%; */
}
.heart-mark-box{
  display: inline-block;
    /* height: 100%; */
    margin-right: 2px;
}
.heart-mark-box img{
    height: 100%;
}
.heart-mark-box .heart-mark-white{
  display: block;
}
.heart-mark-box .heart-mark-red{
  display: none;
}
.heart-mark-box.active-heart .heart-mark-white{
  display: none;
}
.heart-mark-box.active-heart .heart-mark-red{
  display: block;
}
.heart-mark-box.heart-anime img{
  animation: heart-anime 0.5s;
}
@keyframes heart-anime{
  0%{transform: scale(1);}
  25%{transform: scale(0.8);}
  40%{transform: scale(1.1);}
  65%{transform: scale(0.9);}
  80%{transform: scale(1.2);}
  100%{transform: scale(1);}
}
/* @media(max-width:450px){
    .article-list .heart-mark-box{
      width: 15px;
    }
    .article-list .good-btn span{
      font-size: 10px;
    }
} */
</style>
