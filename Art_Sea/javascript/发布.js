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
    }function checkImage(){
        if(document.getElementById("image").value == ""){
            alert("image must not be empty");
            return false;
        }else{
            var fileType = document.getElementById("image").files[0].type;
            if(fileType != "image/jpg" && fileType != "image/jpeg" && fileType != "image/png"){
                alert("please upload .jpg .jpeg or .png file");
                return false;
            }else{return true;}
        }
    }function checkImageType(){
        if(document.getElementById("image").value !== ""){
            var fileType = document.getElementById("image").files[0].type;
            if(fileType != "image/jpg" && fileType != "image/jpeg" && fileType != "image/png"){
                alert("please upload .jpg .jpeg or .png file");
                return false;
            }else{return true;}
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
          && checkWidth() && checkHeight() && checkPrice() && checkImage()){
            release();
        }else {alert("Does not meet the release requirements!");}
    }}
    if(document.getElementById("modifyBtn") !== null){
    document.getElementById("modifyBtn").onclick = function (){
        if(checkTitle() && checkArtist() && checkDescription() && checkYearOfWork() && checkGenre()
          && checkWidth() && checkHeight() && checkPrice() && checkImageType()){
            modify();
        }else {alert("Does not meet the modification requirements!");}
    }}
}

function release(){
    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
        if(xmlhttp.responseText === "success"){
            alert("Release successfully!");
            window.open("个人中心.php","_self");
        }else {
            alert("Release unsuccessfully! Please check whether the database is connected.");
        }
    }
    }
    let formdata = new FormData(document.forms[0]);
    xmlhttp.open("POST","./php/发布.php",true);
    xmlhttp.send(formdata);
}
function modify(){
    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
        if(xmlhttp.responseText === "success"){
            alert("Modify successfully!");
            window.open("个人中心.php","_self");
        }else {
            alert("Modify unsuccessfully! Please check whether the database is connected.");
        }
    }
    }
    
    let formdata = new FormData(document.forms[0]);
    xmlhttp.open("POST","./php/发布.php",true);
    xmlhttp.send(formdata);
}

function showImage(files){
    var file = files[0];
    if(!/image\/jpg/.test(file.type) && !/image\/jpeg/.test(file.type) && !/image\/png/.test(file.type)){ 
        alert("please upload .jpg .jpeg or .png file"); 
        return false; 
    }
    var reader = new FileReader(); 
    //将文件以Data URL形式读入页面 
    reader.readAsDataURL(file); 
    reader.onload=function(e){ 
        var imageResult = document.getElementById("imageResult"); 
        imageResult.innerHTML='<img src="' + this.result +'" class="img-responsive">'; 
    } 
}