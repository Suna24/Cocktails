// Create a new list item when clicking on the "Add" button
function newElement() {
    let div = document.createElement("div");
    div.className = "ingredient";

    let ingInput = document.createElement("input");
    setUpClassesAttributes(ingInput, "nameIngredient", "Ingrédient");

    let quantityInput = document.createElement("input");
    setUpClassesAttributes(quantityInput, "quantite", "Quantité");

    let unityInput = document.createElement("input");
    setUpClassesAttributes(unityInput, "unite", "Unité");

    div.appendChild(ingInput);
    div.appendChild(quantityInput);
    div.appendChild(unityInput);

    let firstNode = document.getElementById("firstNode");
    firstNode.after(div);
}

function setUpClassesAttributes(element, className, placeholder){
    element.className = className;
    element.type = "text";
    element.placeholder = placeholder;
}

function getIngredients(){
    let results = document.querySelectorAll(".ingredient");
    let listeIngredients = [];
    for (let i = 0; i < results.length; i++) {
        let ing = results[i].querySelector(".nameIngredient").value;
        let quantite = results[i].querySelector(".quantite").value;
        let unite = results[i].querySelector(".unite").value;
        listeIngredients.push(new Ingredient(ing, quantite, unite));
    }
    return listeIngredients;
}

function customSubmit() {
    const payload = document.getElementById("payload");

    let listeIngredients = getIngredients();
    let nomCocktail = document.getElementById("cocktailName").value;
    let recetteCocktail = document.getElementById("recette").value;
    let photoCocktail = document.getElementById("photo").value;

    let cocktail = {
        nom: nomCocktail,
        recette: recetteCocktail,
        photo: photoCocktail,
        ingredients: listeIngredients
    }
    console.log(JSON.stringify(cocktail));
    payload.value = JSON.stringify(cocktail);
    document.forms["ajouter"].submit();
}

let saveCocktail = document.getElementById("addCocktail");
saveCocktail.addEventListener('click', customSubmit);


