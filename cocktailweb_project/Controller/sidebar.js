function openNav() {
    document.getElementById("openbtn_id").classList.add("hidden");
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.getElementById("nav").style.gridTemplateColumns = "2em auto 2em";
    console.log("Ouverture");
}

function closeNav() {
    document.getElementById("openbtn_id").classList.remove("hidden")
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.getElementById("nav").style.gridTemplateColumns = "15em auto 15em";
    console.log("fermeture");
}