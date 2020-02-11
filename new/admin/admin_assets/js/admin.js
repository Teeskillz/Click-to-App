




// custom code




// select option .. 

// initialize materialize function .. 
document.addEventListener('DOMContentLoaded', function() {

    // select
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, {});

    // Collapsible
    var elems = document.querySelectorAll('.collapsible');
    var instances = M.Collapsible.init(elems, {});

});


// // $(document).ready(function(){
// jQuery(document).ready(function($){
//     $('select').formSelect();
// });

// $(document).ready(function(){
// // jQuery(document).ready(function($){
//     $('select').formSelect();
// });

// console.log(typeof $);
// if (typeof $ == 'undefined' ) {
//     console.log('exist..');
// }


jQuery(document).ready(function ($) {

        $('select').formSelect();
        $('.collapsible').collapsible();

});





jQuery(document).ready(function ($) {


    // $('.color-wp').wpColorPicker();
    $('.ht-ctc-color').wpColorPicker();


    // #####  show/Hide - chat option #####
  
   //  show_hide option - other settings page
   var ctc_show_hide_display = document.querySelectorAll('.ctc_show_hide_display');

   // var hidebased = document.querySelector('.hidebased');
   var hidebased = document.querySelectorAll('.hidebased');
   var showbased = document.querySelectorAll('.showbased');
   
   // default display
   function ctc_show_hide_default_display() {
  
       var val = $('.select_show_or_hide').find(":selected").val();

       if (val == 'show') {
           // showbased.classList.add('show-hide_display-block');
           showbased.forEach(function (e) {
               e.classList.add('show-hide_display-block');
           });
       } else if (val == 'hide') {
           // hidebased.classList.add('show-hide_display-block');
           hidebased.forEach(function (e) {
               e.classList.add('show-hide_display-block');
           });
       } 
   };
   
   ctc_show_hide_default_display();


   //  incase display-block is added remove it .. onchange
   function ctc_show_hide_display_remove() {
       ctc_show_hide_display.forEach(function (e) {
           e.classList.remove('show-hide_display-block');
       });
   };


    $(".select_show_or_hide").on("change", function (e) {

       // var x = e.target;
       var val = e.target.value;
   
       if (val == 'show') {
           ctc_show_hide_display_remove();

           // showbased.classList.add('show-hide_display-block');
           showbased.forEach(function (e) {
               e.classList.add('show-hide_display-block');
           });

       } else if (val == 'hide') {
           ctc_show_hide_display_remove();

           //   hidebased.classList.add('show-hide_display-block');
           hidebased.forEach(function (e) {
               e.classList.add('show-hide_display-block');
           });
       } 
     });

    // #####  show/Hide - chat option #####
     



//   color .. 

if ( $(".ht-ctc-color") ) {
    if ( $(".ht-ctc-color").spectrum ) {
    $(".ht-ctc-color").spectrum({
    preferredFormat: "hex",
    showInput: true,
    allowEmpty:true,
    chooseText:'Select',
    // showPalette: true,
    // showSelectionPalette: true,
    // palette: [ 'red', 'green', 'blue' ],
    // localStorageKey: "spectrum.homepage",
    });
    }
}
  


});