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
