
likeNb = 0;
dislikeNb = 0;

function addLike(){
    console.log("like");
    document.getElementById("like").innerHTML = "LIKE " + likeNb++;
}

function addDislike(){
    console.log("dislike");
    document.getElementById("dislike").innerHTML = "DISLIKE " + dislikeNb++;
}