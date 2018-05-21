function addTag(e,aTag) { // quand on clique sur un tag.
        
    e.preventDefault();

    // si le tag n'est pas déjà dans l'url,
    if( document.location.href.indexOf(aTag) == -1 ) {

        // s'il n'y a pas encore de tags dans l'url on met ?tag= ,
        if ( document.location.href.indexOf("?tag") == -1 ) {

            document.location.href="?tag="+aTag;

        } else { // sinon on rajoute juste le nouveau tag.
            document.location.href+=","+aTag;
        }
    }
}

function removeTag(e,aTag) { // quand on clique sur un tag selectionné.

    e.preventDefault();
    var myLoc = document.location.href;

    if (myLoc.search(aTag)) { // si ce tag existe bien dans l'url,

        if (myLoc.search(","+aTag)>-1) { // tag derrière un autre
            myLoc = myLoc.replace(","+aTag,""); // on le supprime avec sa virgule.

        } else if (myLoc.search("tag="+aTag+",")>-1) { // tag avec liste derrière
            myLoc = myLoc.replace(aTag+",",""); // on le supprime avec sa virgule.

        } else { // sinon c'est que le tag est seul
            myLoc = "index.php"; // on vide l'url.
        }

        document.location.href=myLoc;

    }

}