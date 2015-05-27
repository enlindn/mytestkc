$(document).ready(function(){
    //press enter
    $('input#icon_password').keydown(function(e) {
        if (e.which == 13) {
            $("#login-in").click();
            return false;
        } 
    });
    
    
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

<<<<<<< Updated upstream
$("#login-in").click(function() {
    var username = $('#icon_username').val();
    var password = $('#icon_password').val();
    if (username == '') {
        Materialize.toast("Username can not be null.", 1000);
        $('#icon_username').focus();
    }
    else if (password == '') {
        Materialize.toast("Password can not be null", 1000);
        $('#icon_password').focus();
    }
    else {
        $.ajax({
            type: "POST",
            url: "/Project/mytestkc/php/doAction.php?action=loginin&sid" + Math.random(),
            dataType: 'json',
            data: {"username": username, "password": password},
            beforeSend: function () {
                Materialize.toast("Authenticating...", 1000);
            },
	    error: function (json) {

		alert(json.sucess);},
            success: function (json) {
                if (json.success == 1) {
                    Materialize.toast(json.msg, 1000);
                    for (var item in json.session) {
                        Materialize.toast(item + ": " + json.session[item] , 2000);
                    }
                    window.location.href = "file.php";
                } else {
                    Materialize.toast(json.msg, 1000);
                }
            }
        });
    }
    return false;
});
 
=======

>>>>>>> Stashed changes
