// $('#myCarousel').carousel({
//     interval: 4000
// });
//
// // handles the carousel thumbnails
// $('[id^=carousel-selector-]').click( function(){
//   var id_selector = $(this).attr("id");
//   var id = id_selector.substr(id_selector.length -1);
//   id = parseInt(id);
//   $('#myCarousel').carousel(id);
//   $('[id^=carousel-selector-]').removeClass('selected');
//   $(this).addClass('selected');
// });
//
// // when the carousel slides, auto update
// $('#myCarousel').on('slid', function (e) {
//   var id = $('.item.active').data('slide-number');
//   id = parseInt(id);
//   console.log("*********id : "+id)
//   $('[id^=carousel-selector-]').removeClass('selected');
//   $('[id=carousel-selector-'+id+']').addClass('selected');
// });/**
//  * Created by r630166 on 8/5/17.
//  */

// $('img').bind('contextmenu', function(e){
//     return false;
// });


$("body").on("contextmenu", "img", function(e) {
    // alert("Sorry, right click is not allowed !!");
  return false;
});

setTimeout(function() {
    $('#succsessNotice').fadeOut('fast');
}, 5000);
