function deleteArtwork(artworkID){
    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
        alert(xmlhttp.responseText);
        location.reload();
    }
    }

    xmlhttp.open("GET","./php/删购.php?artworkID=" + artworkID,true);
    xmlhttp.send();
}