<template>
  <div class="side-menu-wrapper">
    <a class="side-menu-open-btn" @click="Open = true">
      <div></div>
      <div></div>
      <div></div>
    </a>
    <div class="side-menu-bg" @click="Open = false" :class="{menuopen:Open}"></div>
    <div class="side-menu-box" :class="{menuopen:Open}">
    <slot></slot>
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
};
</script>

<style scoped>
.side-menu-wrapper{
    position: fixed;
    right: 0;
    top: 0;
}
.side-menu-open-btn{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    width: 64px;
    height: 64px;
    background-color: #3B3B3B;
    padding: 35% 28%;
}
.side-menu-open-btn div{
    width: 100%;
    height: 2px;
    background-color: #505050;
    background-color: #fff;
}
.side-menu-box{
    visibility: hidden;
    position: fixed;
    z-index: 51;
    top:0;
    right:-320px;
    background-color: #7D7D7D;
    height: 100vh;
    overflow: scroll;
    width: 300px;
    padding: 20px 30px;
    transition: all 0.3s;
    -ms-overflow-style: none;    /* IE, Edge 対応 */
    scrollbar-width: none;       /* Firefox 対応 */
}
.side-menu-box::-webkit-scrollbar {  /* Chrome, Safari 対応 */
        display:none;
}
.side-menu-box.menuopen{
    visibility: visible;
    right: 0;
}
.side-menu-prof-box{
    text-align: center;
    border-bottom: #353535 1px solid;
    padding-bottom: 5px;
}
.side-menu-prof-img{
    border-radius: 50%;
    width: 70px;
    margin-bottom: 5px;
}
.side-menu-inner{
    margin-top:35px;
}
.side-menu-inner li{
    border: 1px solid #3d3d3d;
    padding: 5px;
    margin-top:10px;
    height: 40px;
    border-radius: 22px;
}
.side-menu-inner li.bg-gray{
  background-color: rgba(59, 59, 59, 0.08);
}
.side-menu-inner li *{
    font-size: 14px;
}
.side-menu-inner li>*{
    display: flex;
    align-items: center;
    /* justify-content: center; */
    width: 100%;
    height: 100%;
    padding-left: 25px;
}
.side-menu-inner li input[type="submit"]{
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding: 0;
    width: 100%;
    text-align: left;
    border: none;
    outline: none;
    background: transparent;
}
.side-menu-inner li .icon{
  height: 16px;
  margin-right: 7px;
  opacity: 0.7;
}
.side-menu-bg{
    visibility: hidden;
    width: 100%;
    height: 100vh;
    z-index: 50;
    top:0;
    left:0;
    position: fixed;
    background-color: rgba(0, 0, 0, 0.75);
    transition: all 0.45s;
    opacity:0;
}
.side-menu-bg.menuopen{
  visibility: visible;
  opacity: 1;
}
.sub-menu-box{
  margin-top: 15px;
}
.sub-menu{
  display: inline-block;
  margin-top: 5px;
}
.side-menu-line{
  border-bottom: 1px solid #000;
  margin: 25px 0;
}
@media(max-width:1600px){
  .side-menu-box{
    width: 250px;
    padding: 20px 25px;
  }
  .side-menu-inner{
    margin-top:20px;
  }
  .side-menu-inner li{
    margin-top:7px;
    height: 35px;
  }
  .side-menu-inner li *{
    font-size: 13px;
  }
  .side-menu-inner li>*{
    padding-left: 10px;
  }
  .side-menu-inner li .icon{
    margin-right: 5px;
  }
  .side-menu-line{
    border-bottom: 1px solid #000;
    margin: 20px 0;
  }
}
@media(max-width:450px){
  .side-menu-inner li *{
    font-size: 12px;
  }
  .side-menu-inner li .icon{
  height: 13px;
  }
  .side-menu-prof-img{
    width: 50px;
  }
  .side-menu-open-btn{
    width: 50px;
    height: 50px;
    padding: 35% 28%;
  }
}
</style>
