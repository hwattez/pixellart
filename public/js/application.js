// Au chargement de la page
$(function()
{
    $(".minHeightScreen").css("min-height", $(window).height() + "px");
    $('#videos').mixItUp();
    initialisation();
});

// Au scroll de la page
$(window).scroll(function()
{
    var scrollTop = $(this).scrollTop();
    dynamicBackground(scrollTop);
});

function dynamicBackground(scrollTop)
{
    var limitInferieur = $("body").height() - $(window).height();
    var percentSup = scrollTop/$("header").height()*100;
    var percentInf = (1 - (scrollTop-limitInferieur) / $(window).height()) * 100 - 85;
    
    if(percentSup < 100)
        $("body").css('background-position','0 ' + percentSup + '%');
    else if(percentInf<100)
        $("body").css('background-position','0 ' + percentInf + '%');
    else
        $("body").css('background-position','0 100%');
}

function initialisation(){
    var optionsCarte = {
        zoom: 14,
        center:  new google.maps.LatLng(50.2537449, 2.8948495),
        scrollwheel: false
    }
    var maCarte = new google.maps.Map(document.getElementById("map"), optionsCarte);
}