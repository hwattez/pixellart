// Au chargement de la page
$(function()
{
    $(".minHeightScreen").css("min-height", $(window).height() + "px");
    $('#videos').mixItUp();
    $( ".infoVideo").on( "click", modalUpdate );
    $('#myModal').on('hidden.bs.modal', modalDelete );
    initialisation();
});

// Au scroll de la page
$(window).scroll(function()
{
    var scrollTop = $(this).scrollTop();
    dynamicBackground(scrollTop);
});

// A l'envoie du message
$('#msgButton').click(function(){sendMessage();});

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

function modalUpdate(){

    var youtube = $(this).attr('data-youtube');
    var description = $(this).attr('data-description');
    var title = $(this).children('.videoTitle').text();
    var url = $(this).children('a').attr('href');

    $('.embed-responsive-item').attr('src', youtube);
    $('.modal-title').text(title);
    $('.modal-footer .description').text(description);
    $('.modal-footer .facebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + url);
    $('.modal-footer .twitter').attr('href', 'http://twitter.com/home?status=' + title + ' ' + url + ' @WattezL');
    $('.modal-footer .googleP').attr('href', 'https://plus.google.com/share?url=' + url);

}

function modalDelete(){

    $('.embed-responsive-item').attr('src', '');
    $('.modal-title').text('');

}

function sendMessage()
{
    var nom = $('#nom').val();
    var email = $('#email').val();
    var website = $('#website').val();
        website = website != ''  ? website : 'null';
    var message = $('#message').val();

    if(nom != '' && email != '' && message != '')
        $.get( "/home/message/" + nom + "/" + email + "/" + website + "/" + message + "/", function( data ) {
            sweetAlert('Bonne nouvelle !', 'Le message a bien été envoyé !', 'success');
        });
}

// Google Analytics
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-67521657-1', 'auto');
ga('send', 'pageview');