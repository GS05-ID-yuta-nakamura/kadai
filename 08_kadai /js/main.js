$(document).ready(function(){
    //rating
    $(function raty() {
         $("#rate").raty({
              number: 10,
              score : <?=$bbscore?>
         });
    });
    $.fn.raty.defaults.path = "images";
    $('#rate').raty();
    
    //show
    (function($){
    $(function(){
        $(document)
            .on('click', '.popup_btn', function(){

                $('.popup').show();
                $('#overlay').show();

                return false;
            })
            .on('click', '.close_btn, #overlay', function(){
                $('.popup, #overlay').hide();
                return false;
            });
    });
    })(jQuery);
});