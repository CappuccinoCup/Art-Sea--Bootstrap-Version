/* 设置登录与注册检测 */
function setSign(){
    var signInInput = document.getElementById("signIn").getElementsByTagName("input");
    var signUpInput = document.getElementById("signUp").getElementsByTagName("input");
    var formOfSignIn = document.getElementById("formOfSignIn");
    var formOfSignUp = document.getElementById("formOfSignUp");
    var signUpErrors = document.getElementsByClassName("signUpError");


    document.getElementById("signInCancel").onclick = function(){
        for(var i = 0;i < signInInput.length;i++){
            signInInput[i].value = "";
        }
        document.getElementById("signInError1").className = "invisible";
        document.getElementById("signInError2").className = "invisible";
    }    
    document.getElementById("signUpCancel").onclick = function(){
        for(var i = 0;i < signUpInput.length;i++){
            signUpInput[i].value = "";
            signUpErrors[i].innerHTML = "<br>";
        }
    }
    document.getElementById("signInBtn").onclick = function(){
        document.getElementById("signInError1").className = "invisible";
        document.getElementById("signInError2").className = "invisible";
        //检测是否符合登录要求
        if(document.getElementById("signInUsername").value == ""){
            document.getElementById("signInError1").className = "";
        }else if(document.getElementById("signInPassword").value == ""){
            document.getElementById("signInError2").className = "";
        }else{
            formOfSignIn.submit();
        }
    }
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
    document.getElementById("signUpPassword").onblur = checkPassword;
    document.getElementById("signUpRePassword").onblur = checkRepassword;
    document.getElementById("signUpTel").onblur = checkTel;
    document.getElementById("signUpAddress").onblur = checkAddress;
    document.getElementById("signUpBtn").onclick = function signIn(){
        if(checkUsername() && checkEmail() && checkPassword() && checkRepassword() && checkTel() && checkAddress()){
            formOfSignUp.submit();
        }else {alert("不符合注册要求！");}
    }
}