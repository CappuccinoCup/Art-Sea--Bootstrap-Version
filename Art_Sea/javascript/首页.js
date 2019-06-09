/* 设置自定义滚屏 */
function setImageChange(){
    var imageOnShow = 0;
    var images = document.getElementsByClassName("self-scrollScreen")[0].getElementsByTagName("img");
    var btns = document.getElementsByClassName("self-scrollScreen")[0].getElementsByTagName("button");
    var introduction = document.getElementsByClassName("self-introduction");
    var workIDs = document.getElementsByClassName("self-workID");

    
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
    function changeIntroduction(){
        introduction[3].innerHTML = introduction[imageOnShow].innerHTML;
        document.getElementById("workID").value = workIDs[imageOnShow].innerHTML;
    }
    for(var i = 1;i < btns.length;i++){
        btns[i].onclick = function(num){
            return function(){
                closeImage();
                closeButtonColor();
                imageOnShow = num - 1;
                openImage();
                openButtonColor();
                changeIntroduction();
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
        changeIntroduction();
    }

    setInterval(changeImage,7000);
}