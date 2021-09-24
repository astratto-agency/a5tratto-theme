$(function() {
    setTimeout(function() {
        $('body').addClass('loaded');





        /* TODO impostare */










    }, 1000);

});

$(document).ready(function() {

    $(".menu-icon").on("click", function() {
        $("nav ul").toggleClass("showing");
    });


});









$('body').show();
$('.version').text(NProgress.version);
NProgress.start();
setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);

$("#b-0").click(function() { NProgress.start(); });
$("#b-40").click(function() { NProgress.set(0.4); });
$("#b-inc").click(function() { NProgress.inc(); });
$("#b-100").click(function() { NProgress.done(); });