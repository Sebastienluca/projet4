// A $( document ).ready() block.
$( document ).ready(function() {

    var editeur = Object.create(Editeur);
    editeur.init();

    var design = Object.create(Design);
    design.init();

});