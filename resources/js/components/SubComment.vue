<template>
  <div>
    <a
      @click="
        isActive = !isActive;
        selectIndex = null;
      "
      class="reply-box-open-btn"
      >返信
    </a>
    <div class="reply-box" v-if="isActive">
      <textarea
        @keyup="textareaHeight"
        v-model="SubCommentParamsA.sub_comment"
        placeholder="返信内容を入力"
        rows="1"
      ></textarea>
      <a
        @click="sendSubComment(SubCommentParamsA,$event)"
        class="comment-btn"
        :subcomentId="1"
        >送信
      </a>
    </div>
    <div>
      <a
        v-if="SubCommentList.length > 0"
        @click="replyListActive = !replyListActive"
        class="reply-list-btn"
        >{{ SubCommentList.length }} 件の返信を<span v-if="!replyListActive"
          >表示<img src="../../../public/img/arrow-white-down.png"></span
        ><span v-else>非表示<img src="../../../public/img/arrow-white-up.png"></span></a
      >
    </div>
    <div v-if="replyListActive"
      >
        <div 
          v-for="subcomme in SubCommentList"
          class="subcomment-item"
          :key="subcomme.id"
          :id="'subcomme' + subcomme.id"
        >
          <div class="subcomment-item-inner">
            <a
              class="comment-user-img"
              :href="'/users/detail/' + subcomme.user.display_id"
            >
              <img :src="subcomme.user.prof_image_path" />
            </a>
            <div>
              <p class="comment-user-name">
                {{ subcomme.user.name }}　<span>{{ subcomme.created_at }}</span>
              </p>
            </div>
            <div class="comment-edit-box">
              <post-edit-menu
                btntype="comment2"
                :commeid="subcomme.id"
                @deleteSubComment="deleteSubComment"
                :userflag="subcomme.user.id === userId"
                :role="role"
                :endpoint-violation="endpointViolation"
                :comment="subcomme.sub_comment"
              ></post-edit-menu>
            </div>
          </div>
          <p class="comment-text">
            <span class="to-user-name">@{{ subcomme.to_user_name }}</span
            >{{ subcomme.sub_comment }}</p>
          <a
            @click="
              selectIndex = selectIndex == subcomme.id ? null : subcomme.id;
              isActive = false;
            "
            class="reply-box-open-btn"
            >返信</a
          >
          <div v-if="subcomme.id === selectIndex" class="reply-box">
            <textarea
              @keyup="textareaHeight"
              v-model="subcomme.newcome"
              placeholder="返信内容を入力"
              rows="1"
            ></textarea>
            <!-- ↑subcommeにnewcomeというkeyで入力値を追加してくれる。（ v-model="SubCommentParamsB.sub_comment"とした場合、全ての入力欄の値が同期してしまう。）-->
            <a
              @click="
                SubCommentParamsB.sub_comment = subcomme.newcome;
                SubCommentParamsB.to_user_name = subcomme.user.name;
                SubCommentParamsB.to_subcomment_id = subcomme.id;
                sendSubComment(SubCommentParamsB,$event);
              "
              class="comment-btn"
              :subcomentId="1"
              >送信
            </a>
          </div>
        </div>
    </div>
  </div>
</template>
<script>
import PostEditMenu from "./PostEditMenu.vue";

export default {
  components: {
    PostEditMenu: PostEditMenu,
  },
  props: {
    userId: {
      type: Number,
      default: 0,
    },
    commentId: {
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
    userflag: {
      type: Boolean,
      default: false,
    },
    subcommentId: {
      type: Number,
      default: 0,
    },
    authorized: {
      type: Boolean,
      default: false,
    },
    commeUserName: {
      type: String,
    },
  },
  data() {
    return {
      SubCommentList: [],
      SubCommentParamsA: {
        comment_id: this.commentId,
        user_id: this.userId,
        sub_comment: "",
        to_user_name: this.commeUserName,
        type: "a-type",
      },
      SubCommentParamsB: {
        comment_id: this.commentId,
        user_id: this.userId,
        sub_comment: "",
        to_user_name: "",
        to_subcomment_id: "",
        type: "b-type",
      },
      isActive: false,
      replyListActive: false,
      selectIndex: null,
    };
  },
  methods: {
    sendSubComment(params,e) {
      e.target.style ="pointer-events:none";
      // 二重送信防止のためいったんnoneにする
      if (!this.authorized) {
        alert("コメントはログイン中のみ送信できます");
        return;
      }

      axios
        .post("/comment/sendsubcomment", params)
        .then((response) => {
          this.getSubComment();
          this.SubCommentParamsA.sub_comment = "";
          this.SubCommentParamsB.sub_comment = "";
          this.replyListActive = true;
          this.selectIndex = null;
          this.isActive = false;
        })
        .catch((error) => {
          alert("入力内容が正しくありません。");
          console.log(error);
        })
        .finally(() =>{
          e.target.style ="pointer-events:auto";
           // noneにしていたのをautoに戻す
        })

    },
    deleteSubComment(commeid) {
      axios
        .delete("/comment/deletesubcomment", { data: { commeid: commeid } })
        .then((res) => {
          this.getSubComment();
        });
    },

    async getSubComment() {
      const response = await axios.get(
        "/comment/getsubcomment?comment_id=" + this.commentId
      );
      this.SubCommentList = response.data.slice().reverse();
    },
    textareaHeight(e) {
      e.target.style = "height:auto";
      e.target.style = "height:" + e.target.scrollHeight + "px";
    },
  },
  created() {
    this.getSubComment();
  },
};
</script>

<!--<style>-->
<style scoped>
.subcomment-item {
  border-top: 1px solid rgba(255, 255, 255, 0.4);
  padding: 10px 0 10px 50px;
}
.subcomment-item-inner {
  display: flex;
  align-items: center;
  margin-bottom: 5px;
}
.subcomment-item:first-of-type {
  margin-top: 8px;
}
.subcomment-item:last-of-type {
  padding-bottom: 0;
}
.reply-box {
  display: flex;
  max-width: 600px;
  margin: 10px auto 0 auto;
  align-items: flex-end;
}
.reply-box-open-btn {
  color: #ffffff;
  background-color: #4f5a61;
  display: inline-block;
  margin-top: 5px;
  font-size: 12px;
  user-select: none;
  border-radius: 15px;
  padding: 5px 15px;
}
.to-user-name {
  color: #d3d3d3;
  display: inline-block;
  margin-right: 5px;
}
.reply-list-btn,
.reply-list-btn span {
  color: #d3d3d3;
  display: inline-block;
  margin-top: 5px;
  user-select: none;
}
.reply-list-btn span img{
  height: 10px;
  margin-left: 8px;
  image-rendering: -webkit-optimize-contrast;
  vertical-align: middle;

}
 
@media (max-width: 850px) {
  .subcomment-item {
    padding: 3% 0 3% 8%;
  }
}
</style>
