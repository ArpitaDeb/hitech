//function parallaxInit(){$("#clients").parallax("50%",.3)}



$(document).ready(function(){
	$(".item_top").each(function(){$(this).appear(function(){$(this).delay(200).animate({opacity:1,top:"0px"},1e3)})});
	$(".item_bottom").each(function(){$(this).appear(function(){$(this).delay(200).animate({opacity:1,bottom:"0px"},1e3)})});
	$(".item_left").each(function(){$(this).appear(function(){$(this).delay(200).animate({opacity:1,left:"0px"},1e3)})});
	$(".item_right").each(function(){$(this).appear(function(){$(this).delay(200).animate({opacity:1,right:"0px"},1e3)})});
	$(".item_fade_in").each(function(){$(this).appear(function(){$(this).delay(250).animate({opacity:1,right:"0px"},1500)})});
	
	$(".item_zoom").each(function(){$(this).appear(function(){$(this).delay(250).addClass("zoomShow");})});
	
});