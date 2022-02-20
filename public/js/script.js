// Menu fixed
var MenuScroll=function(){
	$(window).scroll(function(){
		if($(window).scrollTop() >$('.slider-banner').height()){
			$('.header-menu').addClass('fixed');
		}
		else{
			$('.header-menu').removeClass('fixed');

		}
	});
};

// Back to top
var Backtotop = function(){
	$('.btn-top').click(function(){
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	});
};



// Slider
$(document).ready(function(){
	$('.slider-banner').slick({
		dots: true,
		infinite: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 2000
	});



	// $('.menu').find("ul li").each(function() {
	// 	if($(this).find("ul>li").length > 0){
	// 		$(this).append('<i class="fa fa-angle-down btn-drop" aria-hidden="true"></i>');
	// 	}
	// });
	// $('.btn-menu').click(function(){
	// 	$(this).children('i').toggleClass('fa-bars').toggleClass('fa-close');
 //    	$('.menu').children('ul').slideToggle(200);
	// });

	// $('.btn-drop').click(function(){
	// 	$(this).toggleClass('fa-angle-down').toggleClass('fa-angle-up');
	// 	$(this).parent('li').children('ul').toggleClass('active');
	// });




	$('.menu1').find("ul li").each(function() {
		if($(this).find("ul>li").length > 0){
			$(this).append('<i class="fa fa-angle-down btn-drop1" aria-hidden="true"></i>');
		}
	});
	$('.btn-menu').click(function(){
    	$('.menu1').addClass('show');
	});
	$('.btn-menu1').click(function(){
		$('.menu1').removeClass('show');
	});
	$('.btn-drop1').click(function(){
		$(this).toggleClass('fa-angle-down').toggleClass('fa-angle-up');
		$(this).parent('li').children('ul').toggleClass('active1');
	});






// input cart
	var number=$('.input-number').val();
	$('.plus').click(function(){
		var val = parseInt(number);
	  	val= val + 1;
	  	number= val;
	  	$('.input-number').val(val);
	});

	$('.minus').click(function(){
		var val = parseInt(number);
	  	if(number ==1){
	  		val=1;
	  	}
	  	else{
	  		val= val - 1;
	  	}
	  	$('.input-number').val(val);

	  	number = val;

	});

	

	$('.slider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.slider-nav'
		});
	$('.slider-nav').slick({
		slidesToShow: 3,
		slidesToScroll: 3,
		asNavFor: '.slider-for',
		dots: true,
		focusOnSelect: true,
		arrows: false,
		dots: false,
		
		responsive: [
		    {
		      breakpoint: 767,
		      settings: {
		        slidesToShow: 4,
		        slidesToScroll: 4
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3
		      }
		    }

		  ]
		});
});

$(function(){
	MenuScroll();
	Backtotop();
});




// Footer
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


// news-detail

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

