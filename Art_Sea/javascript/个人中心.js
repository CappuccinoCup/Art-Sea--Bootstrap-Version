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