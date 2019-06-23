function setRelease(){

    function checkTitle(){
        document.getElementById("titleError").className = "invisible";
        if(document.getElementById("title").value == ""){
            document.getElementById("titleError").className = "";
            return false;
        }else {return true;}
    }
    function checkArtist(){
        document.getElementById("artistError").className = "invisible";
        if(document.getElementById("artist").value == ""){
            document.getElementById("artistError").className = "";
            return false;
        }else {return true;}
    }function checkDescription(){
        document.getElementById("desError").className = "invisible";
        if(document.getElementById("description").value == ""){
            document.getElementById("desError").className = "";
            return false;
        }else {return true;}
    }function checkYearOfWork(){
        document.getElementById("yearOfWorkError").className = "invisible";
        if(document.getElementById("yearOfWork").value == ""){
            document.getElementById("yearOfWorkError").className = "";
            return false;
        }else if(!/^[0-9]+$/.test(document.getElementById("yearOfWork").value)){
            document.getElementById("yearOfWorkError").innerHTML = "&nbsp;please enter a positive integer";
            document.getElementById("yearOfWorkError").className = "";
            return false;
        }else{return true;}
    }function checkGenre(){
        document.getElementById("genreError").className = "invisible";
        if(document.getElementById("genre").value == ""){
            document.getElementById("genreError").className = "";
            return false;
        }else {return true;}
    }function checkWidth(){
        document.getElementById("widthError").className = "invisible";
        if(document.getElementById("width").value == ""){
            document.getElementById("widthError").className = "";
            return false;
        }else if(!/^[0-9]+$/.test(document.getElementById("width").value)){
            document.getElementById("widthError").innerHTML = "&nbsp;please enter a positive integer";
            document.getElementById("widthError").className = "";
            return false;
        }else{return true;}
    }function checkHeight(){
        document.getElementById("heightError").className = "invisible";
        if(document.getElementById("height").value == ""){
            document.getElementById("heightError").className = "";
            return false;
        }else if(!/^[0-9]+$/.test(document.getElementById("height").value)){
            document.getElementById("heightError").innerHTML = "&nbsp;please enter a positive integer";
            document.getElementById("heightError").className = "";
            return false;
        }else{return true;}
    }function checkPrice(){
        document.getElementById("priceError").className = "invisible";
        if(document.getElementById("price").value == ""){
            document.getElementById("priceError").className = "";
            return false;
        }else if(!/^[0-9]+$/.test(document.getElementById("price").value)){
            document.getElementById("priceError").innerHTML = "&nbsp;please enter a positive integer";
            document.getElementById("priceError").className = "";
            return false;
        }else{return true;}
    }

    document.getElementById("title").onblur = checkTitle;
    document.getElementById("artist").onblur = checkArtist;
    document.getElementById("description").onblur = checkDescription;
    document.getElementById("yearOfWork").onblur = checkYearOfWork;
    document.getElementById("genre").onblur = checkGenre;
    document.getElementById("width").onblur = checkWidth;
    document.getElementById("height").onblur = checkHeight;
    document.getElementById("price").onblur = checkPrice;
    if(document.getElementById("releaseBtn") !== null){
    document.getElementById("releaseBtn").onclick = function (){
        if(checkTitle() && checkArtist() && checkDescription() && checkYearOfWork() && checkGenre()
          && checkWidth() && checkHeight() && checkPrice()){
            release();
        }else {alert("不符合发布要求！");}
    }}
    if(document.getElementById("modifyBtn") !== null){
    document.getElementById("modifyBtn").onclick = function (){
        if(checkTitle() && checkArtist() && checkDescription() && checkYearOfWork() && checkGenre()
          && checkWidth() && checkHeight() && checkPrice()){
            modify();
        }else {alert("不符合修改要求！");}
    }}
}

function release(){
    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
        if(xmlhttp.responseText === "success"){
            alert("发布成功！");
            window.open("个人中心.php","_self");
        }else {
            alert("发布失败！请检查数据库是否已连接。");
        }
    }
    }
    var ownerID = document.getElementById("ownerID").value;
    var title = document.getElementById("title").value;
    var artist = document.getElementById("artist").value;
    var description = document.getElementById("description").value;
    var yearOfWork = document.getElementById("yearOfWork").value;
    var genre = document.getElementById("genre").value;
    var width = document.getElementById("width").value;
    var height = document.getElementById("height").value;
    var price = document.getElementById("price").value;
    alert('发布');
    // xmlhttp.open("POST","./php/发布.php",true);
    // xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    // xmlhttp.send("");
}
function modify(){
    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
        if(xmlhttp.responseText === "success"){
            alert("修改成功！");
            window.open("个人中心.php","_self");
        }else {
            alert("修改失败！请检查数据库是否已连接。");
        }
    }
    }
    var title = document.getElementById("title").value;
    var artist = document.getElementById("artist").value;
    var description = document.getElementById("description").value;
    var yearOfWork = document.getElementById("yearOfWork").value;
    var genre = document.getElementById("genre").value;
    var width = document.getElementById("width").value;
    var height = document.getElementById("height").value;
    var price = document.getElementById("price").value;
    alert('修改');
    // xmlhttp.open("POST","./php/发布.php",true);
    // xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    // xmlhttp.send("");
}