function like() {
    let like = document.getElementsByClassName("like");

    for (let i = 0; i < like.length; i++) {
        like[i].addEventListener('click', (e) => {
            like[i].parentElement.parentElement.parentElement.className = "container";
            let nbLike = parseInt(document.getElementsByClassName("like")[i].innerHTML);
            nbLike += 1;
            let numberOfLike = nbLike.toString();
            document.getElementsByClassName("like")[i].innerHTML = numberOfLike;

            let nom = document.getElementsByClassName("title")[i].textContent.split("\n")[0];

            XMLRequest("like", nom);
        });
    }
}

function dislike() {
    let dislike = document.getElementsByClassName("dislike");

    for (let i = 0; i < dislike.length; i++) {
        dislike[i].addEventListener('click', (e) => {
            dislike[i].parentElement.parentElement.parentElement.className = "container";
            let nbDislike = parseInt(document.getElementsByClassName("dislike")[i].innerHTML);
            nbDislike += 1;
            let numberOfDislike = nbDislike.toString();
            document.getElementsByClassName("dislike")[i].innerHTML = numberOfDislike;

            let nom = document.getElementsByClassName("title")[i].textContent.split("\n")[0];

            XMLRequest("dislike", nom);
        });
    }
}

function XMLRequest(likeOrDislike, name) {
    let XMLHttp = new XMLHttpRequest();

    XMLHttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            console.log("Send");
            //console.log(this.responseText);
        }
    }

    let request = "../Model/BDDToLikeSystem.php";

    XMLHttp.open("POST", request, true);
    XMLHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    XMLHttp.send("name=" + name + "&" + likeOrDislike + "=increment");
}