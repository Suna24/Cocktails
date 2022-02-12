const all_ingredients = [];
window.onload = onLoad();

async function onLoad(){
    //TODO set all_ingredients
    showHint();
    loadBar();
    displayBDDIngredients();
    //await new Promise(resolve => setTimeout(resolve, 500));
    setTimeout(() => {
    var x = document.getElementById("ingredients").options;
    var i;
    for (i = 0; i < x.length; i++) {
        all_ingredients.push(x[i].value);
    }
    }, 500);

}
function showHint() {
    let request = "../Model/BDDToCocktailManager.php?";
    var ing_values = [];
    var i;
    $('#myUL li').each(function() {
        ing_values.push($(this).text());
    });
    ing_values = ing_values.map(e => e.replace(/.$/, ""))
    console.log(ing_values.length);
    console.log(ing_values);

    let str = document.getElementById("cocktailNameSearch").value;
    const XMLHttp = new XMLHttpRequest();
    XMLHttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
        }
    };
    if(ing_values.length!==0 && str.length!==0){
        request+="q="+str;
        //ajout des ingrédients dans la recherche
        for (i=0;i<ing_values.length;i++){
            request+="&check_list[]="+ing_values[i];
        }

    } else if(ing_values.length!==0) {
        //ajout des ingrédients dans la recherche
        for (i=0;i<ing_values.length;i++){
            request+="&check_list[]="+ing_values[i];
        }

    } else if (str.length!==0){
        request+="q="+str;
    }
    console.log(request);
    XMLHttp.open("GET", request, true);
    XMLHttp.send();
}

/**************************************************************************************************************************/
/** Fonction pour  display la datalist des ingrédients **/
function displayBDDIngredients(){
    let searchBar = document.getElementById("searchIngredients").value;
    var XMLHttp = new XMLHttpRequest();

    XMLHttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("ingredients").innerHTML = this.responseText;
        }
    }

    XMLHttp.open("GET", "../Model/BDDtoIngredients.php?ing=" + searchBar, true);
    XMLHttp.send();
}

/**************************************************************************************************************************/
/** Fonction pour  add les tags des ingrédients (fonctionnement toDolist) **/
// Create a "close" button and append it to each list item
var myNodelist = document.getElementsByTagName("LI");
var i;
for (i = 0; i < myNodelist.length; i++) {
    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00D7");
    span.className = "close";
    span.appendChild(txt);
    myNodelist[i].appendChild(span);
}

// Click on a close button to hide the current list item
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
        var div = this.parentElement;
        div.style.display = "none";
    }
}

// Add a "checked" symbol when clicking on a list item
var list = document.querySelector('ul');
list.addEventListener('click', function(ev) {
    if (ev.target.tagName === 'LI') {
        ev.target.classList.toggle('checked');
    }
}, false);

// Create a new list item when clicking on the "Add" button
function newElement() {
    var li = document.createElement("li");
    li.classList.add("item");
    var inputValue = document.getElementById("searchIngredients").value;
    var t = document.createTextNode(inputValue);
    li.appendChild(t);
    if (inputValue === '') {
        alert("You must write something!");
    } else if (checkInput(inputValue)===false) {
        return;
    } else {
        document.getElementById("myUL").appendChild(li);
    }
    document.getElementById("searchIngredients").value = "";

    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00D7");
    span.className = "close";
    span.appendChild(txt);
    li.appendChild(span);

    for (i = 0; i < close.length; i++) {
        close[i].onclick = function() {
            var li_ing = this.parentElement;
            var ul_ing_selected = li_ing.parentElement;
            ul_ing_selected.removeChild(li_ing);
            showHint();
            if (ul_ing_selected.childNodes.length === 0){
                displayBDDIngredients();
            }

        }
    }
    showHint();
}

function checkInput(inputValue){
    var toReturn;
    if(all_ingredients.map(e => e.toLowerCase()).includes(inputValue.trim().toLowerCase())){
        console.log("il est dans la liste");
        toReturn = true;
        $('#myUL li').each(function() {
            if($( this ).text().toLowerCase()===inputValue.trim().toLowerCase()+"\u00D7"){
                console.log("j'ai trouvé le même");
                toReturn=false;
                return false;
            }
        });
        return toReturn;
    } else {
        return false;
    }
}

