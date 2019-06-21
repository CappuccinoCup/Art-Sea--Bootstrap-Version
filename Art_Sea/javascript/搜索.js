/* 排序 */
function rank(rankBy){
    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
        document.getElementById("searchResult").innerHTML = xmlhttp.responseText;
    }
    }

    var search = document.getElementById("search").value;
    var searchBy = [];
    var checkBox = document.getElementsByName("searchBy[]");
    for(var i = 0;i < checkBox.length;i++){
        if(checkBox[i].checked == true){
            searchBy[searchBy.length] = checkBox[i].value;
        }
    }
    var url = "./php/排序.php?search=" + search + "&rankBy=" + rankBy;
    for(var i = 0;i < searchBy.length;i++){
        url += "&searchBy[]=" + searchBy[i];
    }

    xmlhttp.open("GET",url,false);
    xmlhttp.send();
}

/* 分页 */
function changePage(page){
    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
        document.getElementById("searchResult").innerHTML = xmlhttp.responseText;
        var btns = document.getElementById("changePageBtn").getElementsByTagName("li");
        if(page > btns.length || page < 1){page = 1;}
        for(var i = 0;i < btns.length;i++){
            if(i !== page - 1){
                btns[i].className = "";
            }else{
                btns[i].className = "active";
            }
        }
    }
    }

    var search = document.getElementById("search").value;
    var rankBy;
    var rank = document.getElementsByName("rankBy");
    for(var i = 0;i < rank.length;i++){
        if(rank[i].checked == true){
            rankBy = rank[i].value;
        }
    }
    var searchBy = [];
    var checkBox = document.getElementsByName("searchBy[]");
    for(var i = 0;i < checkBox.length;i++){
        if(checkBox[i].checked == true){
            searchBy[searchBy.length] = checkBox[i].value;
        }
    }
    var url = "./php/分页.php?search=" + search + "&rankBy=" + rankBy + "&page=" + page;
    for(var i = 0;i < searchBy.length;i++){
        url += "&searchBy[]=" + searchBy[i];
    }
    //alert(url);

    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}