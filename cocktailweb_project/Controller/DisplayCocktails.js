function display(x){
    if (x.parentNode.classList.contains("closed")) {
        x.parentNode.classList.remove("closed");
    } else {
        x.parentNode.classList.add("closed");
    }
}