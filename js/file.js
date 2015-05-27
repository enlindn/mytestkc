$(document).ready(function() {
    // Plugin initialization
    $('.slider').slider({full_width: true});
    $('.tab-demo').show().tabs();
    $('.parallax').parallax();
    $('.modal-trigger').leanModal();
    $('.scrollspy').scrollSpy();
    $('.button-collapse').sideNav({'edge': 'left'});
    $('.datepicker').pickadate({selectYears: 20});
    $('select').not('.disabled').material_select();

});

$("#login-out").click(function() {
    Materialize.toast("Login Out!", 1000);

    $.ajax({
        type: "POST",
    	url: "/Project/mytestkc/php/doAction.php?action=loginout&sid" + Math.random(),
    	dataType: 'json',
    	data: {},
    	beforeSend: function () {
    	Materialize.toast("Login outing...", 1000);
    	},
    	success: function (json) {
    	if (json.success == 1) {
    	Materialize.toast(json.msg, 1000)
    	window.location.href = "index.php";
    	} else {
    	Materialize.toast(json.msg, 1000);
    	}
    	}
    });
    return false;
});