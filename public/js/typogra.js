// 投稿時の画像プレビュー表示
function previewImage(obj) {
    let fileReader = new FileReader();
     fileReader.onload = (function () {
         document.getElementById('post-img-preview').src = fileReader.result;
         document.getElementById('post-img-preview').style.display = "block";
     });
     fileReader.readAsDataURL(obj.files[0]);
 }

 // フォームの多重送信防止
 for (let i = 0; i < document.forms.length; i++) {
     document.forms[i].addEventListener('submit', function (e) {
         this.querySelector("*[type='submit']").disabled = true;
     });
 }