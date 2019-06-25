function addToShoppingCart(artworkID){
    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
        alert(xmlhttp.responseText);
        if(xmlhttp.responseText === "Add to cart successfully"){
            location.reload();
        }
    }
    }

    xmlhttp.open("GET","./php/加购.php?artworkID=" + artworkID,true);
    xmlhttp.send();
}