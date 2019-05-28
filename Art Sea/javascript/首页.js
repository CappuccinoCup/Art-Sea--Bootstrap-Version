/* 设置自定义滚屏 */
function setImageChange(){
    var imageOnShow = 0;
    var images = document.getElementsByClassName("self-scrollScreen")[0].getElementsByTagName("img");
    var btns = document.getElementsByClassName("self-scrollScreen")[0].getElementsByTagName("button");
    
    function closeImage(){
        images[imageOnShow].className = "";
    }
    function openImage(){
        images[imageOnShow].className = "onShow";
    }
    function closeButtonColor(){
        btns[imageOnShow + 1].style.backgroundColor = "rgb(255,255,255)"
    }
    function openButtonColor(){
        btns[imageOnShow + 1].style.backgroundColor = "rgb(128,128,128)"
    }
    for(var i = 1;i < btns.length;i++){
        btns[i].onclick = function(num){
            return function(){
                closeImage();
                closeButtonColor();
                imageOnShow = num - 1;
                openImage();
                openButtonColor();
            }
        }(i);
    }
    function changeImage() {
        closeImage();
        closeButtonColor();
        imageOnShow++;
        if(imageOnShow >= images.length) imageOnShow = 0;
        openImage();
        openButtonColor();
    }

    setInterval(changeImage,7000);
}