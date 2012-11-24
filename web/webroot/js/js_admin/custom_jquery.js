// 1 - START DROPDOWN SLIDER SCRIPTS ------------------------------------------------------------------------

$(document).ready(function () {
    $(".showhide-account").click(function () {
        $(".account-content").slideToggle("fast");
        $(this).toggleClass("active");
        return false;
    });
});

$(document).ready(function () {
    $(".action-slider").click(function () {
        $("#actions-box-slider").slideToggle("fast");
        $(this).toggleClass("activated");
        return false;
    });
});

//  END ----------------------------- 1

// 2 - START LOGIN PAGE SHOW HIDE BETWEEN LOGIN AND FORGOT PASSWORD BOXES--------------------------------------

$(document).ready(function () {
	$(".forgot-pwd").click(function () {
	$("#loginbox").hide();
	$("#forgotbox").show();
	return false;
	});

});

$(document).ready(function () {
	$(".back-login").click(function () {
	$("#loginbox").show();
	$("#forgotbox").hide();
	return false;
	});
});

// END ----------------------------- 2



// 3 - MESSAGE BOX FADING SCRIPTS ---------------------------------------------------------------------

$(document).ready(function() {
	$("#message-yellow").delay(800).fadeTo(100, 0.01).delay(200).fadeTo(100, 1).delay(200).fadeTo(100, 0.01).delay(200).fadeTo(100, 1).delay(200).fadeTo(100, 0.01).delay(200).fadeTo(100, 1).delay(200).fadeTo(100, 0.01).delay(200).fadeTo(100, 1);
	$("#message-blue").delay(800).fadeTo(100, 0.01).delay(200).fadeTo(100, 1).delay(200).fadeTo(100, 0.01).delay(200).fadeTo(100, 1).delay(200).fadeTo(100, 0.01).delay(200).fadeTo(100, 1).delay(200).fadeTo(100, 0.01).delay(200).fadeTo(100, 1);
	//$("#message-green").delay(800).fadeTo(100, 0.01).delay(200).fadeTo(100, 1).delay(200).fadeTo(100, 0.01).delay(200).fadeTo(100, 1).delay(200).fadeTo(100, 0.01).delay(200).fadeTo(100, 1).delay(200).fadeTo(100, 0.01).delay(200).fadeTo(100, 1);
	$("#message-red").delay(800).fadeTo(100, 0.01).delay(200).fadeTo(100, 1).delay(200).fadeTo(100, 0.01).delay(200).fadeTo(100, 1).delay(200).fadeTo(100, 0.01).delay(200).fadeTo(100, 1).delay(200).fadeTo(100, 0.01).delay(200).fadeTo(100, 1);
	
	$(".close-yellow").click(function () {
		$("#message-yellow").stop().fadeOut("slow");
	});
	$(".close-red").click(function () {
		$("#message-red").stop().fadeOut("slow");
	});
	$(".close-blue").click(function () {
		$("#message-blue").stop().fadeOut("slow");
	});
	$(".close-green").click(function () {
		$("#message-green").stop().fadeOut("slow");
	});
	
	
		// END ----------------------------- 3
	
});

// END ----------------------------- 3



// 4 - CLOSE OPEN SLIDERS BY CLICKING ELSEWHERE ON PAGE -------------------------------------------------------------------------

$(document).bind("click", function (e) {
    if (e.target.id != $(".showhide-account").attr("class")) $(".account-content").slideUp();
});

$(document).bind("click", function (e) {
    if (e.target.id != $(".action-slider").attr("class")) $("#actions-box-slider").slideUp();
});
// END ----------------------------- 4
 
 
 
// 5 - TABLE ROW BACKGROUND COLOR CHANGES ON ROLLOVER -----------------------------------------------------------------------
/*
$(document).ready(function () {
    $('#post-table	tr').hover(function () {
        $(this).addClass('activity-blue');
    },
    function () {
        $(this).removeClass('activity-blue');
    });
});
 */
// END -----------------------------  5
 
 
 
 // 6 - DYNAMIC YEAR STAMP FOR FOOTER -----------------------------------------------------------------------

 $('#spanYear').html(new Date().getFullYear()); 
 
// END -----------------------------  6 
  
