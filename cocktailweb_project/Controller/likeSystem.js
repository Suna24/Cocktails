function oldlike() {
    let like = document.getElementsByClassName("like");

    for (let i = 0; i < like.length; i++) {
        like[i].addEventListener('click', (e) => {
            like[i].parentElement.parentElement.parentElement.className = "container";
            let nbLike = parseInt(document.getElementsByClassName("like")[i].innerHTML);
            nbLike += 1;
            let numberOfLike = nbLike.toString();
            document.getElementsByClassName("like")[i].innerHTML = numberOfLike;

            let nom = document.getElementsByClassName("title")[i].textContent.split("\n")[0];

            XMLRequest("like", nom, i);
        });
    }
}

function olddislike() {
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

// ---------------------------------------------------------------------------------------------------------------------

async function likeSystem() {

    let like = document.getElementsByClassName("like");

    for (let i = 0; i < like.length; i++) {
        like[i].addEventListener('click', async (e) => {
            let nom = document.getElementsByClassName("title")[i].textContent.split("\n")[0];
            await XMLRequest("like", nom, i);
            ;

        });
    }

    let dislike = document.getElementsByClassName("dislike");

    for (let i = 0; i < like.length; i++) {
        dislike[i].addEventListener('click', async (e) => {
            let nom = document.getElementsByClassName("title")[i].textContent.split("\n")[0];
            await XMLRequest("dislike", nom, i);
            ;

        });
    }

    let buttons = document.getElementsByClassName("wrapper-button");

    for (let i = 0; i < like.length; i++) {
        buttons[i].addEventListener('click', async (e) => {
            let nom = document.getElementsByClassName("title")[i].textContent.split("\n")[0];
            let reactions = await refreshValues(i);
            let sepReactions = reactions.split("/");
            let nbLike = sepReactions[0];
            let nbDislike = sepReactions[1];
            console.log(reactions + " LIKE:" + nbLike + " / DISLIKE:" + nbDislike);
            console.log("wrapper id:" + i);

            document.getElementsByClassName("like")[i].innerHTML = nbLike;
            document.getElementsByClassName("dislike")[i].innerHTML = nbDislike;
        });
    }

}


async function XMLRequest(likeOrDislike, name, id) {
    id = id + 1;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../Model/BDDToLikeSystem.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("name=" + name + "&" + likeOrDislike + "=increment" + "&id=" + id);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // console.log("Send");
        }
    }

}

async function refreshValues(id) {
    id = id + 1;
    return await new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../Model/BDDToLikeGetter.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("id=" + id);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                resolve(xhr.responseText);
            }
        }
    });
}