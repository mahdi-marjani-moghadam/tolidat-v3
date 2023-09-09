$(document).ready(function () {

  var $body = $('body');

  $body.on('click', function () {
    //hamburger menu
    if ($('#container-mobile-menu').hasClass('is-active')) {
      $('#container-mobile-menu').removeClass('is-active');
    }
  });


  //hamburger menu
  $('#btn-show-mobile-menu').on("click", function (e) {
    e.stopPropagation();
    if ($('#container-mobile-menu').hasClass('is-active')) {
      $('#container-mobile-menu').removeClass('is-active');
    } else {
      $('#container-mobile-menu').addClass('is-active');
    }
    
  });
  //end of hamburger menu
});