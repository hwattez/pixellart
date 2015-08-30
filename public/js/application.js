// Au chargement de la page
$(function()
{
    $(".minHeightScreen").css("min-height", $(window).height() + "px");
    $('#videos').mixItUp();
    $( ".infoVideo" ).on( "click", modalUpdate );
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
    var title = $(this).children('.videoTitle').text();

    $('.embed-responsive-item').attr('src', youtube);
    $('.modal-title').text(title);

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