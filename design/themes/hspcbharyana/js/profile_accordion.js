// JavaScript Document

$(document).ready(function()
{
	//slides the element with class "accordion_body" when paragraph with class "accordion_head" is clicked 
	$("#firstpane .accordion_head").click(function()
    {
		$(this).css({backgroundImage:"url(d#)"}).next("div.accordion_body").slideToggle(300).siblings("div.accordion_body").slideUp("slow");
       	$(this).siblings().css({backgroundImage:"url(#)"});
	});

});