<template>
  <div class="comment-box">
    
    <div class="comment-post-box">
      <textarea
        ref="comme_textarea"
        @keyup="textareaHeight"
        v-model="commentParams.comment"
        placeholder="コメントを入力"
        rows="1"
      ></textarea>
      <a @click="sendComment($event)" class="comment-btn">送信</a>
    </div>
    <p v-if="commentList === null" class="none-omment-text">
      まだコメントはありません。
    </p>
    <div class="comment-list">
      <div 
      v-for="comme in commentList" 
      class="comment-item" 
      :key="comme.id"
      :id="'comme' + comme.id"
      >
        <div class="comment-item-inner">
          <a class="comment-user-img" :href="'/users/detail/' + comme.user.display_id">
            <img :src="comme.user.prof_image_path" />
          </a>
          <div>
            <p class="comment-user-name">
              {{ comme.user.name }}　<span>{{ comme.created_at }}</span>
            </p>
          </div>
          <div class="comment-edit-box">
            <post-edit-menu
              btntype="comment"
              :commeid="comme.id"
              @deleteComment="deleteComment"
              :userflag="comme.user.id === userId"
              :role="role"
              :endpoint-violation="endpointViolation"
              :comment="comme.comment"
            ></post-edit-menu>
          </div>
        </div>
        <p class="comment-text">{{ comme.comment }}</p>
        <sub-comment
          :user-id="userId"
          :comment-id="comme.id"
          :authorized="authorized"
          :comme-user-name="comme.user.name"
          :role="role"
          :endpoint-violation="endpointViolation"
        ></sub-comment>
      </div>
    </div>
  </div>
</template>
<script>
import PostEditMenu from "./PostEditMenu.vue";
import SubComment from "./SubComment.vue";
export default {
  components: {
    PostEditMenu: PostEditMenu,
    SubComment: SubComment,
  },
  props: {
    userId: {
      type: Number,
      default: 0,
    },
    role: {
      type: Boolean,
      default: false,
    },
    endpointViolation:{
      type:String,
    },
    postId: {
      type: Number,
      default: 0,
    },
    authorized: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      commentList: [],
      commentParams: {
        post_id: this.postId,
        comment: "",
      },
    };
  },
  methods: {
    sendComment(e) {
      e.target.style ="pointer-events:none";
      // 二重送信防止のためいったんnoneにする
      if (!this.authorized) {
        alert("コメントはログイン中のみ送信できます");
        return;
      }
      // csrfトークンは、axiosが自動で取得してヘッダ情報に入れてくれる
      axios
        .post("/comment/sendcomment", this.commentParams)
        .then((response) => {
          // if (response.data.result === true) {
          this.getComment();
          this.commentParams.comment = "";
        })
        .catch((error) => {
          alert("入力内容が正しくありません。");
          console.log(error);
        })
        .finally(()=>{
           e.target.style ="pointer-events:auto";
           // noneにしていたのをautoに戻す
           this.$refs.comme_textarea.style = "height:auto";
        });
    },
    deleteComment(commeid) {
      axios
        .delete("/comment/deletecomment", { data: { commeid: commeid } })
        .then((res) => {
          this.getComment();
        });
    },
    getComment() {
      axios
        .get("/comment/getcomment?post_id=" + this.postId)
        .then((response) => {
          if(response.data.length === 0){
            this.commentList = null;
          }else{
            this.commentList = response.data;
          }
          console.log(this.commentList);
        })
        .catch((error) => {
          alert("コメント読み込み時にエラーが発生しました");
          console.log(error);
        })
        ;
    },
    textareaHeight(e) {
      e.target.style = "height:auto";
      e.target.style = "height:" + e.target.scrollHeight + "px";
    },
  },
  created() {
    this.getComment();
  },
};
</script>

<!--subcomment.vueでも使うstyleがあるのでスコープ無し-->
<style>
.comment-box {
  padding: 17px 0px;
  margin: -14px auto;
  margin-top: 20px;
  border: none;
  max-width: 600px;
}
.comment-post-box {
  display: flex;
  justify-content: space-between;
  max-width: 600px;
  margin: 0 auto;
  align-items: flex-end;

}
.comment-box textarea {
  width: 100%;
  margin-right: 10px;
  background-color: #e4e4e4;
  background-color: #e4e4e4;
  background-color: #DFE2E4;
  padding: 5px 10px;
  border: solid 1px #747474;
  color: #000;
  /* border: solid 1px #606E78; */
  border: none;
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.comment-box textarea::-webkit-scrollbar {
  display: none;
}
.comment-box textarea::placeholder {
  color: rgba(0, 0, 0, 0.6);
}
.none-omment-text{
  padding: 20px 0;
  border-bottom: 1px solid rgba(255, 255, 255, 0.5);
  border-top: 1px solid rgba(255, 255, 255, 0.5);
  margin-top: 40px;
}
.comment-list {
  margin-top: 35px;
}
.comment-item {
  border-top: 1px solid rgba(255, 255, 255, 0.4);
  padding: 10px 0;
}
.comment-item-inner {
  display: flex;
  align-items: center;
  /* align-items: flex-start; */
  margin-bottom: 5px;
}
.comment-item:first-of-type {
  margin-top: 8px;
}
.comment-item:last-of-type {
  border-bottom: 1px solid rgba(255, 255, 255, 0.4);
  margin-bottom: 40px;
}
.comment-user-img {
  display: block;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-right: 7px;
  overflow: hidden;
  flex-shrink: 0;
}
.comment-user-name,.comment-user-name span{
  font-size: 11px;
  /* opacity: 0.7; */
}
.comment-text {
  white-space: pre-wrap;
}
.comment-btn {
  margin-left: auto;
  display: inline-block;
  flex-shrink: 0;
  font-size: 12px;
  text-align: center;
  /* border: 1px solid #a3a3a3; */
  border-radius: 15px;
  padding: 5px 15px;
  color: #000;
  background-color: #e4e4e4;
  background-color: #DFE2E4;
}
.comment-edit-box {
  margin-left: auto;
}
@media (max-width: 850px) {
  .comment-box {
    padding: 3% 0;
  }
  .comment-item {
    padding: 3% 0;
  }
}
</style>
