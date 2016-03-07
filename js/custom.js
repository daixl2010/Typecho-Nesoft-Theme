jQuery(document).ready(function($) {
	
	/* go-top go-btm go-comt*/
    $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $("html") : $("body")) : $("html,body");
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 100) {
			jQuery(".go-up").css("right", "20px");
		} else {
			jQuery(".go-up").css("right", "-60px");
		}
	});
	jQuery(".go-up").click(function () {
		$body.animate({
			scrollTop : 0
		}, 500);
		return false;
	});
	
/*  jQuery(".go-up").click(function() {
        $body.animate({
            scrollTop: 0
        },
        400)
    });
    jQuery(".go-btm").click(function() {
        $body.animate({
            scrollTop: $(document).height()
        },
        400)
    });
    jQuery(".go-comt").click(function() {
        $body.animate({
            scrollTop: $("#comments").offset().top
        },
        400)
    }); */
	
/* Menu */
	

	
	/* Header mobile */
	
	jQuery(".navigation > ul > li").clone().appendTo('.navigation_mobile > ul');
	
	if (jQuery(".navigation_mobile_click").length) {
		jQuery(".navigation_mobile_click").click(function() {
			if (jQuery(this).hasClass("navigation_mobile_click_close")) {
				jQuery(this).next().slideUp(500);
				jQuery(this).removeClass("navigation_mobile_click_close");
			}else {
				jQuery(this).next().slideDown(500);
				jQuery(this).addClass("navigation_mobile_click_close");
			}
		});
		
		jQuery(".navigation_mobile ul li").each(function() {	
			var sub_menu = jQuery(this).find("ul:first");
			jQuery(this).find("> a").click(function() {
				if (jQuery(this).parent().find("ul").length > 0) {
					if (jQuery(this).parent().find("> ul").hasClass("sub_menu")) {
						jQuery(this).parent().find("> ul").removeClass("sub_menu");
						sub_menu.stop().slideUp(250, function() {	
							jQuery(this).css({overflow:"hidden", display:"none"});
						});
					}else {
						jQuery(this).parent().find("> ul").addClass("sub_menu");
						sub_menu.stop().css({overflow:"hidden", height:"auto", display:"none", paddingTop:0}).slideDown(250, function() {
							jQuery(this).css({overflow:"visible", height:"auto"});
						});
					}
					return false;
				}else {
					return true;
				}
			});	
		});
	}
	
	jQuery(".navigation_mobile > ul > li a.button").removeClass("button");
	
});
