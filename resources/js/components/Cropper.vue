<template>
  <div style="font-size: 14px; text-align: center">
    <!-- <input type="file" name="image" accept="image/*" ref="fileinput" @change="setImage" /> -->
    <div class="profedit-img-box">
      <img class="old-prof-img" :src="profImgUrl" alt="">
      <img class="new-prof-img" v-if="cropImg != ''" :src="cropImg" />
      <label for="prof-edit-img">
        <img src="/img/icon/icon-camera.png" alt="">
      </label>
      <input id="prof-edit-img" type="file" name="prof_image" accept="image/*" ref="fileinput" @change="setImage" />
    </div>
    <input type="hidden" name="cropX" ref="cropX" />
    <input type="hidden" name="cropY" ref="cropY" />
    <input type="hidden" name="cropW" ref="cropW" />
    <input type="hidden" name="cropH" ref="cropH" />
    <div class="crop-modal-box" v-if="modalflag">
      <div class="crop-modal">
        <vue-cropper
          ref="cropper"
          :guides="false"
          :view-mode="1"
          drag-mode="move"
          :auto-crop-area="1.0"
          :min-container-width="250"
          :min-container-height="250"
          :minCanvasHeight="250"
          :background="true"
          :rotatable="false"
          :aspectRatio="1 / 1"
          :cropBoxMovable="false"
          :cropBoxResizable="false"
          :toggleDragModeOnDblclick="false"
          :src="imgSrc"
          :img-style="{ width: '100%', height: 'auto' }"
        >
          <!---->
        </vue-cropper>
        <br />
        <div class="zoombtn-box">
          <a id="zoomin-btn" @click="zoomIn"></a>
          <a id="zoomout-btn" @click="zoomOut"></a>
        </div>
        <div class="page-type2_btn-box mt20">
        <a class="page-type2__cancel-btn" @click="cancel">キャンセル</a>
        <a class="page-type2__enter-btn" @click="cropImgFunc" v-if="imgSrc != ''">決定</a>
        </div>
      </div>
    </div>
    
  </div>
</template>

<script>
import VueCropper from "vue-cropperjs";
import "cropperjs/dist/cropper.css";
export default {
  components: {
    VueCropper,
  },
  data() {
    return {
      //   tate: 1,
      //   yoko: 2,
      imgSrc: "",
      cropImg: "",
      filename: "",
      modalflag: false,
    };
  },
  props:{
    profImgUrl:{
      type:String,
    }
  },
  methods: {
    setImage(e) {
      const file = e.target.files[0];
      this.filename = file.name;
      if (!file.type.includes("image/")) {
        alert("画像以外のファイルは選択しないで下さい");
        return;
      }
      if (typeof FileReader === "function") {
        // この部分は選択されたファイルを表示するための定型処理
        // 「event.target.result」はロードされた画像のurl情報
        const reader = new FileReader();
        reader.onload = (event) => {
          this.imgSrc = event.target.result;
          this.$refs.cropper.replace(event.target.result);
        };
        reader.readAsDataURL(file);
      } else {
        alert("Sorry, FileReader API not supported");
      }
      this.modalflag = true;
      console.log(this.$refs.fileinput.value);
    },
    cancel() {
      this.$refs.fileinput.value = "";
      this.modalflag = false;
    },
    cropImgFunc() {
      this.cropImg = this.$refs.cropper.getCroppedCanvas().toDataURL();
      this.modalflag = false;
      const cropParam = this.$refs.cropper.getData();
      this.$refs.cropX.value = Math.round(cropParam["x"]);
      this.$refs.cropY.value = Math.round(cropParam["y"]);
      this.$refs.cropW.value = Math.round(cropParam["width"]);
      this.$refs.cropH.value = Math.round(cropParam["height"]);
    },
    zoomIn() {
      this.$refs.cropper.relativeZoom(0.1);
    },
    zoomOut() {
      this.$refs.cropper.relativeZoom(-0.1);
    },
  },
};
</script>

<style>
/* ↑子コンポーネントである<vue-cropper>にもスタイルあてる必要があるため
スコープ使わない */
.crop-modal-box {
  position: fixed;
  top: 0;
  left: 0;
  background-color: rgba(0, 0, 0, 0.8);
  width: 100%;
  height: 100vh;
  z-index: 20;
  display: flex;
  overflow: scroll;
}
.crop-modal {
  margin: auto;
  background-color: #6B7B86;
  padding: 30px;
  max-width: 300px;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
.zoombtn-box {
  width: 170px;
  display: flex;
  justify-content: space-between;
}
#zoomin-btn,
#zoomout-btn {
  font-family: sans-serif;
  background-color: #a3a3a3;
  border-radius: 5px;
  font-size: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 80px;
  height: 30px;
  /* line-height: 30px; */
  position: relative;
}
#zoomout-btn {
  font-size: 40px;
}
#zoomout-btn::before,
#zoomin-btn::before,
#zoomin-btn::after {
  content: "";
  position: absolute;
  width: 15px;
  height: 3px;
  background-color: #fff;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
#zoomin-btn::after {
  width: 3px;
  height: 15px;
}
.cropper-face {
  background: radial-gradient(
    transparent 70%,
    #fff 70%,
    #fff 70.7%,
    #000 70.7%
  ) !important;
  opacity: 0.5 !important;
}
.cropper-view-box {
  outline: none !important;
}
</style>
