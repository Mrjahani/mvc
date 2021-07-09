$(document).ready(function () {
    $("#FadeInButton").click(function (e) {
        // $(selector).fadeIn();

        // $("#FadeInTest p").fadeIn();
        // $("#FadeInTest p").fadeIn(2000);
        // $("#FadeInTest p").fadeIn("slow");
        // $("#FadeInTest p").fadeIn(1000,function(){
        //     console.log('hello');
        // });

        $("#FadeInTest p").first().fadeIn(1000, function NextFade() {
            $(this).next("p").fadeIn(1000, NextFade);
        });
    });



    $("#FadeOutButton").click(function (e) {
        // $(selector).fadeOut();
        // $("#FadeOutTest p").fadeOut();
        // $("#FadeOutTest p").fadeOut(1000);
        // $("#FadeOutTest p").fadeOut("fast");

        // $("#FadeOutTest p").fadeOut(1000, function () {
        //     console.log('hello');
        // });

        $("#FadeOutTest p:last-child()").fadeOut(1000, function PrevFade() {
            $(this).prev("p").fadeOut(1000, PrevFade);
        });
    });

    $(".colored").click(function (e) {
        // $(selector).fadeTo(duration, opacity);
        // $(this).fadeTo(200, 0.2);
        $(this).fadeTo(200, 0.2,function(){
            console.log('test');
        });
    });

    $("#FadeToggleButton").click(function (e) { 
        $("#FadeToggleTest p").fadeToggle(200);
    });
});

$(document).ready(function(){
    $("[id*='name']").on('change',function(){
        var data = $(this).val();
        alert(data);
    });
});
