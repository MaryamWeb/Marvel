$(document).ready(function () {

    $("#body-page-loader").prepend();
    $('.loader_background').delay(700).fadeOut('slow', function(){
        $(this).remove();
    })

    //WYSIWYG Editor
    ClassicEditor
    .create( document.querySelector( '#bodyeditor' ) )
    .catch( error => {
        console.error( error );
    } );

    //Navbar Toggle Button
    $(".navbar-toggler").click(function(){
        $("nav").toggleClass("navbar-grey-background");
        });

    //Color Navbar Scroll
    $(document).scroll(function () {
        var $nav = $("#main-nav");
        var $img = $("#marvel-banner");
        $nav.toggleClass("scrolled", $(this).scrollTop() > $img.height());
    });

   
    
});
 
   
 
 
