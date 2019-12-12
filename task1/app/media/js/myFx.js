$(document).ready(function() {
   var sideMenu = false;
    $(".switch-button").click(function() {
      if (!sideMenu) {
        $("#form-background").animate({left: "2.5%"});
        $(".login").fadeOut(500);
        setTimeout(function(){jQuery('.signup').fadeIn()}, 500);
        sideMenu = true;
      }
      else {
        $("#form-background").animate({left: "50%"});
        $(".signup").fadeOut(500);
        setTimeout(function(){jQuery('.login').fadeIn()}, 500);
        sideMenu = false;     
      }
    });
});