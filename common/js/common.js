// JavaScript Document
$(document).ready(function(){
    
	$(".menu_tags a").click(function(){
		if($(this).hasClass('active')){
			return false;
		}else{
			$(".menu_tags a").removeClass('active');
			$(this).addClass('active');
			$(".content_tags .tags").removeClass('active');
			$("#"+$(this).attr("href")).addClass('active');
		}
		return false;
	})
    $('span.price').autoNumeric('init',{
        aSep: ' ',
        vMin: '0', 
        aPad: false
    });
    if($("#mainmenu li.active").length==0){
        $("#mainmenu li").each(function(){
            var n = document.URL.indexOf($(this).children('a').attr('href')); 
            if(n!=-1){
                $(this).addClass('active');
            }
        })
    }
})
function fixViewColumn(column){
    $('.products .product,.items .item').each(function(){
        if($(this).index()%column==column-1){
            $(this).css('margin-right','0');
        }
    })
}
$(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
        $("#gototop").fadeIn();
    } else {
        $("#gototop").fadeOut();
    }
});
$(window).resize(function() {
    if ($(window).scrollTop() > 300) {
        $("#gototop").fadeIn();
    } else {
        $("#gototop").fadeOut();
    }
})
