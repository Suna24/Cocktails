function like(){
    let like = document.getElementsByClassName("like");

    for (let i = 0; i < like.length; i++) {
        like[i].addEventListener('click', (e) => {
            like[i].parentElement.parentElement.parentElement.className = "container";
            let nbLike = parseInt(document.getElementsByClassName("like")[i].innerHTML);
            nbLike += 1;
            let numberOfLike = nbLike.toString();
            document.getElementsByClassName("like")[i].innerHTML = numberOfLike;
        });
    }
}

function dislike(){
    let dislike = document.getElementsByClassName("dislike");

    for (let i = 0; i < dislike.length; i++) {
        dislike[i].addEventListener('click', (e) => {
            dislike[i].parentElement.parentElement.parentElement.className = "container";
            let nbDislike = parseInt(document.getElementsByClassName("dislike")[i].innerHTML);
            nbDislike += 1;
            let numberOfDislike = nbDislike.toString();
            document.getElementsByClassName("dislike")[i].innerHTML = numberOfDislike;
        });
    }
}