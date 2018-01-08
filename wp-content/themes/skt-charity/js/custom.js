jQuery(window).load(function() {
		if(jQuery('#slider') > 0) {
        jQuery('.nivoSlider').nivoSlider({
        	effect:'random',
    });
		} else {
			jQuery('#slider').nivoSlider({
        	effect:'random',
    });
		}
});
	

// NAVIGATION CALLBACK
var ww = jQuery(window).width();
jQuery(document).ready(function() { 
	jQuery(".sitenav li a").each(function() {
		if (jQuery(this).next().length > 0) {
			jQuery(this).addClass("parent");
		};
	})
	jQuery(".toggleMenu").click(function(e) { 
		e.preventDefault();
		jQuery(this).toggleClass("active");
		jQuery(".sitenav").slideToggle('fast');
	});
	adjustMenu();
})

// navigation orientation resize callbak
jQuery(window).bind('resize orientationchange', function() {
	ww = jQuery(window).width();
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 981) {
		jQuery(".toggleMenu").css("display", "block");
		if (!jQuery(".toggleMenu").hasClass("active")) {
			jQuery(".sitenav").hide();
		} else {
			jQuery(".sitenav").show();
		}
		jQuery(".sitenav li").unbind('mouseenter mouseleave');
	} else {
		jQuery(".toggleMenu").css("display", "none");
		jQuery(".sitenav").show();
		jQuery(".sitenav li").removeClass("hover");
		jQuery(".sitenav li a").unbind('click');
		jQuery(".sitenav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
			jQuery(this).toggleClass('hover');
		});
	}
}

jQuery(document).ready(function() {
  	jQuery('.srchicon').click(function() {
			jQuery('.searchtop').toggle();
			jQuery('.topsocial').toggle();
		});	
});
	
jQuery(document).ready(function() {
        jQuery('.services-wrap .one_third h4, .welcomewrap h2').each(function(index, element) {
            var heading = jQuery(element);
            var word_array, last_word, first_part;

            word_array = heading.html().split(/\s+/); // split on spaces
            last_word = word_array.pop();             // pop the last word
            first_part = word_array.join(' ');        // rejoin the first words together

            heading.html([first_part, ' <span>', last_word, '</span>'].join(''));
        });
});	

// came from header
var menuToggle = false;
var meetingToggle = false;

function toggleMenu() {
    //     jQuery("#menu-slider").animate({ "margin-left": 0 }, "slow");
    if (meetingToggle) toggleMeetings();
    if (menuToggle) jQuery("#menu-slider").css('margin-left', '0');
    else {
        jQuery("#menu-slider").css('margin-left', '-19em');
        jQuery("#menu-slider").focus();
    }
    menuToggle = !menuToggle;
}

function toggleMeetings() {
    //     jQuery("#menu-slider").animate({ "margin-left": 0 }, "slow");
    if (menuToggle) toggleMenu();
    if (meetingToggle) jQuery("#menu-slider2").css('margin-left', '0');
    else {
        jQuery("#menu-slider2").css('margin-left', '-19em');
        jQuery("#menu-slider2").focus()
    }
    meetingToggle = !meetingToggle;
}


// ** came from page 
    function bsCarouselAnimHeight() {
    jQuery('.carousel').carousel({
        interval: 5000
    }).on('slide.bs.carousel', function (e) {
        var nextH = jQuery(e.relatedTarget).outerHeight();
        jQuery(this).find('.active.item').parent().animate({
            height: nextH
        }, 500);
    });}


    function appendIndicator(carousel, indicators)
    {

      var myCarousel = jQuery(carousel);
        var indicators = jQuery(indicators); 

        myCarousel.find(".carousel-inner").children(".item").each(function(index) {

            (index === 0) ? 
            indicators.append("<li data-target='"+ carousel +"' data-slide-to='"+index+"' class='active'></li>") : 
            indicators.append("<li data-target='" + carousel + "' data-slide-to='"+index+"'></li>");
        });     
    }

    bsCarouselAnimHeight();

    appendIndicator('#myCarousel1', '#myCarouselIndicator1');
    appendIndicator('#myCarousel2', '#myCarouselIndicator2');
    jQuery(window).resize(function() {

        var $carousel = jQuery('#myCarousel1Inner');
            $carousel.css("height", "auto");

            $carousel = jQuery('#myCarousel2Inner');
            $carousel.css("height", "auto");
    });

    // end come from page