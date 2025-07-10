$('.dropdown-toggle').click(function(event){
	event.stopPropagation();
});

$(document).ready(function() {
    
	$('ul.nav li.dropdown').hover(function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
	}, function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
	});    
	
	/*============================================
	Scroll To Top
	==============================================*/	

	//When distance from top = 250px fade button in/out
	$(window).scroll(function(){
		if ($(this).scrollTop() > 250) {
			$('#scrollup').fadeIn(300);
		} else {
			$('#scrollup').fadeOut(300);
		}
	});

	//On click scroll to top of page t = 1000ms
	$('#scrollup').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 1000);
		return false;
	});               
	$('.upload').css({'min-height':($(window).height())+'px'});
	$("#file").change(function () {
		$(".video-post, .image-post").css({'display':'none'});
		$("input[name='filter_id']").css("checked", false);
		var owl = $(".owl-carousel");
		owl.trigger('destroy.owl.carousel', [100]);
		if (!this.files[0])
			return false;
		var file = this.files[0];
		var imagefile = file.type;
		var match = $(this).attr('accept');
		if (jQuery.inArray(imagefile, match) !== -1) {
			alert("لطفا فایل را از فرمت های معرفی شده انتخاب کنید");
		} else {
			var images = $("video .image-post");
			images.attr("src", "");
			images.attr("data-src", "");
			var mystr = imagefile.split("/");
			var reader = new FileReader();
			if (mystr[0] == "image")
				reader.onload = imageIsLoaded;
			if (mystr[0] == "video")
				reader.onload = videoIsLoaded;
			reader.readAsDataURL(file);
			var eagerLoad = 0;
			if ($(window).width() < 400)
				eagerLoad = 2;
			owl.owlCarousel({
				lazyLoad:true,
				lazyLoadEager: eagerLoad,
				rtl:true,
				margin:10,
				navSpeed:1000,
				dots:true,
				responsive:{
					0:{
						items:2,
					},
					600:{
						items:4,
					},
					1000:{
						items:4,
					}
				}
			});
		}
		
		function imageIsLoaded(e)
		{
			var images = $(".image-post");
			images.attr('data-src', e.target.result);
			var to = 4;
			for(var i = 0; i<= to; i++){
				$(".image-post"+i).attr('src', e.target.result);
			}
			$(".image-post").css({'display':'block'});
		}

		function videoIsLoaded(e)
		{
			var videos = $(".video-post");
			videos.attr('src', e.target.result);
			var to = 4;
			for(var i = 0; i<= to; i++){
				$(".video-post"+i).attr('src', e.target.result);
			}
			$(".video-post").css({'display':'block'});
		}
	})
});