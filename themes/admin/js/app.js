$(document).ready(function(){
    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        //alert(scrollTop);
        if(scrollTop > 41) {
            $('#left-sidebar').css('position','fixed');
        } else {
            $('#left-sidebar').css('position','absolute');
        }
    });
});