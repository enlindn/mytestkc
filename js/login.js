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
 