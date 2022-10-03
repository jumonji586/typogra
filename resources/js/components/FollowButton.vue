<template>
    <a class="common-btn1"
      :class="buttonColor"
      @click="clickFollow"   
    >
      {{ buttonText }}
    </a>
</template>

<script>
  export default {
    props: {
      initialIsFollowedBy: {
        type: Boolean,
        default: false,
      },
      //==========ここから追加==========
      authorized: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
      //==========ここまで追加==========
    },
    data() {
      return {
        isFollowedBy: this.initialIsFollowedBy,
      }
    },
    computed: {
      buttonColor() {
        return this.isFollowedBy
          ? 'follow'
          : 'unfollow'
      },
      buttonText() {
        return this.isFollowedBy
          ? 'フォロー済'
          : 'フォローする'
      },
    },
    //==========ここから追加==========
    methods: {
      clickFollow() {
        if (!this.authorized) {
          alert('フォロー機能はログイン中のみ使用できます')
          return
        }

        this.isFollowedBy
          ? this.unfollow()
          : this.follow()
      },
      async follow() {
        const response = await axios.put(this.endpoint)

        this.isFollowedBy = true
      },
      async unfollow() {
        const response = await axios.delete(this.endpoint)

        this.isFollowedBy = false
      },
    },
    //==========ここまで追加==========
  }
</script>
<style>
/* .follow-btn a{
    display: inline-block;
    border: 1px solid #000;
    border-radius: 15px;
    padding: 5px 15px;
    background-color:rgba(255, 255, 255, 0.6);
}
.follow-btn a.follow{
    background-color:#ebebeb;
} */
/* .article-detail .article-item .follow-btn a{
    border: 1px solid #afafaf;
    margin-right: 10px;
} */
</style>
