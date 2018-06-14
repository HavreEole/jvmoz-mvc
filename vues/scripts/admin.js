function modifTag(theId) {
    var newName = prompt("Choisissez un nouveau nom pour ce tag :");
    if (newName != false) { document.getElementById(theId).value=newName; }
}