function deposit(){
    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
        alert(xmlhttp.responseText);
        location.reload();
    }
    }

    var input = document.getElementById('depositNumber');
    var error = document.getElementById('numberError');
    if(!/^[0-9]+$/.test(input.value)){
        error.className = "";
    }else{
        xmlhttp.open("GET","./php/充值.php?number=" + input.value,true);
        xmlhttp.send();
    }
}

function modifyMyArtwork(artworkID){
    window.open('发布.php?artworkID=' + artworkID,'_self');
}
function deleteMyArtwork(artworkID){
    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
        alert(xmlhttp.responseText);
        location.reload();
    }
    }
    var result = confirm("Are you sure to delete this artwork?");  
    if (result == true){ 
        xmlhttp.open("GET","./php/删发布.php?artworkID=" + artworkID,true);
        xmlhttp.send();
    }
}

function setModifyInfo(){

    function checkUsername(){
        document.getElementById("signUpError1").innerHTML = "<br>";
        if(document.getElementById("signUpUsername").value == ""){
            document.getElementById("signUpError1").innerHTML = "用户名为空！";
            return false;
        }else {return true;}
    }
    function checkEmail(){
        document.getElementById("signUpError2").innerHTML = "<br>";
        if(document.getElementById("signUpEmail").value == ""){
            document.getElementById("signUpError2").innerHTML = "邮箱为空！";
            return false;
        }else if(!/^([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)$/.test(document.getElementById("signUpEmail").value)){
            document.getElementById("signUpError2").innerHTML = "请输入正确的邮箱如：XX@XX.XX";
            return false;
        }else {return true;}
    }
    function checkPassword0(){
        document.getElementById("signUpError0").innerHTML = "<br>";
        if(document.getElementById("signUpPassword0").value == ""){
            document.getElementById("signUpError0").innerHTML = "密码为空！";
            return false;
        }else {return true;}
    }
    function checkPassword(){
        document.getElementById("signUpError3").innerHTML = "<br>";
        if(document.getElementById("signUpPassword").value == ""){
            document.getElementById("signUpError3").innerHTML = "密码为空！";
            return false;
        }else if(!/\S{6,}/.test(document.getElementById("signUpPassword").value)  || /^[0-9]+$/.test(document.getElementById("signUpPassword").value)){
            document.getElementById("signUpError3").innerHTML = "密码至少为六位非纯数字，如：12345a";
            return false;
        }else {return true;}
    }
    function checkRepassword(){
        document.getElementById("signUpError4").innerHTML = "<br>";
        if(document.getElementById("signUpRePassword").value == ""){
            document.getElementById("signUpError4").innerHTML = "确认密码为空！";
            return false;
        }else if(document.getElementById("signUpRePassword").value != document.getElementById("signUpPassword").value){
            document.getElementById("signUpError4").innerHTML = "确认密码与密码不同！";
            return false;
        }else {return true;}
    }
    function checkTel(){
        document.getElementById("signUpError5").innerHTML = "<br>";
        if(document.getElementById("signUpTel").value == ""){
            document.getElementById("signUpError5").innerHTML = "电话为空！";
            return false;
        }else {return true;}
    }
    function checkAddress(){
        document.getElementById("signUpError6").innerHTML = "<br>";
        if(document.getElementById("signUpAddress").value == ""){
            document.getElementById("signUpError6").innerHTML = "地址为空！";
            return false;
        }else {return true;}
    }
    document.getElementById("signUpUsername").onblur = checkUsername;
    document.getElementById("signUpEmail").onblur = checkEmail;
    document.getElementById("signUpPassword0").onblur = checkPassword0;
    document.getElementById("signUpPassword").onblur = checkPassword;
    document.getElementById("signUpRePassword").onblur = checkRepassword;
    document.getElementById("signUpTel").onblur = checkTel;
    document.getElementById("signUpAddress").onblur = checkAddress;
    document.getElementById("modifyInfoBtn").onclick = function signIn(){
        if(checkUsername() && checkEmail() && checkPassword0() && checkPassword() && checkRepassword() && checkTel() && checkAddress()){
            modifyInfo();
        }else {alert("不符合修改要求！");}
    }
}
function modifyInfo(){
        var xmlhttp;
        xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            if(xmlhttp.responseText === "success"){
                alert("修改成功！");
                location.reload();
            }else if(xmlhttp.responseText === "fail1"){
                document.getElementById("signUpError1").innerHTML = "用户名已存在！";
            }else if(xmlhttp.responseText === "fail2"){
                document.getElementById("signUpError0").innerHTML = "密码错误！";
            }else if(xmlhttp.responseText === "modifyFail"){
                alert("修改失败！请检查数据库是否可连接。")
            }
        }
        }
    
        let formdata = new FormData(document.getElementById("formOfModifyInfo"));
        xmlhttp.open("POST","./php/修改个人信息.php",true);
        xmlhttp.send(formdata);
}