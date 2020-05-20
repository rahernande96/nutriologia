function autoHeing(){
    //funcion para alinear butones en las cartas
    var maxHeight = Math.max.apply(null, $(".info").map(function ()
    {
        return $(this).height();
    }).get());

    $(".info").height(maxHeight);
}

$( document ).ready(function() {
    autoHeing();
});

$(window).on('resize',function() {
    autoHeing();
});