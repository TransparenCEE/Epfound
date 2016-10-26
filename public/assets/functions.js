$(document).ready(function(){



	// $('header > section.sub-header > nav > ul.main-menu > li').click(function(){

		
	// 	$("header > section.sub-header > nav > ul.main-menu > li").removeClass("main-menu-li-active");
	// 	$(this).addClass("main-menu-li-active");
	// });


	 $('header > section.sub-header > nav > ul.main-menu > li').hover(function(){
	 	$("header > section.sub-header > nav > ul.main-menu > li").removeClass("main-menu-li-active");
		$(this).addClass("main-menu-li-active");
	},
	function(){
		$("header > section.sub-header > nav > ul.main-menu > li").removeClass("main-menu-li-active");
		$('header > section.sub-header > nav > ul.main-menu > li.active1').addClass("main-menu-li-active");
	});

});