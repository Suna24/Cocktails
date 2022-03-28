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

// Initialise les listeners sur les boutons like et dislike
// Permettent de mettre à jour le nombre de likes et de dislikes dans la base de données et ceux affichés
async function likeSystem() {
    await createLikeListener();
    await createDislikeListener();
}


function createLikeListener() {
    let like = document.getElementsByClassName("like");

    for (let i = 0; i < like.length; i++) {
        like[i].addEventListener('click', async (e) => {
            let nom = document.getElementsByClassName("title")[i].textContent.split("\n")[0];
            await refreshValues(await XMLRequest("like", nom, i), i);
            ;

        });
    }
}

function createDislikeListener() {
    let dislike = document.getElementsByClassName("dislike");

    for (let i = 0; i < dislike.length; i++) {
        dislike[i].addEventListener('click', async (e) => {
            let nom = document.getElementsByClassName("title")[i].textContent.split("\n")[0];
            await refreshValues(await XMLRequest("dislike", nom, i), i);
            ;

        });
    }
}


async function XMLRequest(likeOrDislike, name, id) {
    id = id + 1;
    return await new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../Model/BDDToLikeSystem.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("name=" + name + "&" + likeOrDislike + "=increment" + "&id=" + id);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                resolve(this.responseText);
            }
        }
    });
}

async function refreshValues(values, id) {
    let reactions = values.split("/");
    let addLike = parseInt(reactions[0]);
    let addDislike = parseInt(reactions[1]);
    console.log(addLike + " / " + addDislike);

    let actualLike = document.getElementsByClassName("like")[id].innerHTML;
    actualLike = parseInt(actualLike);
    let actualDislike = document.getElementsByClassName("dislike")[id].innerHTML;
    actualDislike = parseInt(actualDislike);

    document.getElementsByClassName("like")[id].innerHTML = actualLike + addLike;
    document.getElementsByClassName("dislike")[id].innerHTML = actualDislike + addDislike;
}