$(document).ready(function() {
    setTimeout(function() {
        $('body').addClass('loaded');

    }, 1000);
});

$(document).ready(function() {
    $(".menu-icon").on("click", function() {
        $("nav ul").toggleClass("showing");
    });
});



