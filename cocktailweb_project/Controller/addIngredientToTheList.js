// Create a new list item when clicking on the "Add" button
function newElement() {
    let div = document.createElement("div");

    let ingInput = document.createElement("input");
    setUp(ingInput, "ingredient", "Ingrédient");

    let quantityInput = document.createElement("input");
    setUp(quantityInput, "quantite", "Quantité");

    let unityInput = document.createElement("input");
    setUp(unityInput, "unite", "Unité");

    div.appendChild(ingInput);
    div.appendChild(quantityInput);
    div.appendChild(unityInput);

    let firstNode = document.getElementById("firstNode");
    firstNode.after(div);
}

function setUp(element, className, placeholder){
    element.className = className;
    element.type = "text";
    element.placeholder = placeholder;
}
