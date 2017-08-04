/**
 * jFriendly : jQuery Plugin to make friendly urls in your forms.
 * by : ikhuerta (ikhuerta@gmail.com)
 * more info :
 **/
(function($){
    $.fn.extend({
        jFriendly : function ( inputUri , notEditable ){
            inputUri = $(inputUri);
            $(this).keyup(function(){
                inputUri.val( uriSanitize($(this).val()) );
            });
            if (notEditable){
                inputUri.css({display:"inline",border:0,background:"transparent",overflow:"visible"}).attr("disabled","disabled");
                $("form").submit(function(){if($(this).find(inputUri)) inputUri.removeAttr("disabled");});
            }
            return inputUri;
        }
    });
})(jQuery);
uriSanitize = function(uri) {
    return String(uri)
        .toLowerCase()
        .split(/[абвгде]/).join("a")
        .split(/ж/).join("ae")
        .split(/з/).join("c")
        .split(/[ийкл]/).join("e")
        .split(/[мноп]/).join("i")
        .split(/с/).join("n")
        .split(/[туфхц]/).join("o")
        .split(/њ/).join("oe")
        .split(/[щъыь]/).join("u")
        .split(/[эя]/).join("y")
        .split(/[\W_]+/).join("-")
        .split(/-+/).join("-");
}