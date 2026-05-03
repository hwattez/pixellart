// Au chargement de la page
$(function()
{
    $(".minHeightScreen").css("min-height", $(window).height() + "px");
    // $('#videos').mixItUp();
    $('#myModal').on('hidden.bs.modal', modalDelete );
    // initialisation();
});

// Remplace ces valeurs par les tiennes
const API_KEY = 'AIzaSyCzu6rSglLLbDqqxf2fGo6t4GumUsRaud8';
const CHANNEL_ID = 'UCFabwJ1_1dWVDSzWoiAgnJQ';
const MAX_RESULTS = 50; // Maximum autorisé par l'API YouTube Search

// URL de l'API YouTube Data
const API_URL = `https://www.googleapis.com/youtube/v3/search?key=${API_KEY}&channelId=${CHANNEL_ID}&part=snippet&order=date&maxResults=${MAX_RESULTS}`;

function getLoadingStatusElement() {
    let statusElement = document.getElementById('videosLoadingStatus');

    if (!statusElement) {
        statusElement = document.createElement('div');
        statusElement.id = 'videosLoadingStatus';
        statusElement.className = 'col-xs-12';
        statusElement.style.cssText = 'padding:20px 0;text-align:center;color:#fff;font-size:16px;letter-spacing:.04em;';

        const videoContainer = document.getElementById('videos');
        if (videoContainer && videoContainer.parentNode) {
            videoContainer.parentNode.insertBefore(statusElement, videoContainer);
        }
    }

    return statusElement;
}

function updateLoadingStatus(loadedCount, expectedCount) {
    const statusElement = getLoadingStatusElement();
    if (!statusElement) {
        return;
    }

    statusElement.textContent = expectedCount
        ? `Chargement des vidéos... ${loadedCount} / ${expectedCount}`
        : `Chargement des vidéos... ${loadedCount}`;
}

function hideLoadingStatus() {
    const statusElement = document.getElementById('videosLoadingStatus');
    if (statusElement && statusElement.parentNode) {
        statusElement.parentNode.removeChild(statusElement);
    }
}

function renderVideos(items) {
    const videoContainer = document.getElementById('videos');

    items.forEach(item => {
        const videoId = item.id && item.id.videoId;
        const videoTitle = item.snippet.title;
        const videoDescription = item.snippet.description;
        const thumbnails = item.snippet.thumbnails;
        const thumbnailHigh = (thumbnails.high && thumbnails.high.url) || thumbnails.medium.url; // 480x360 px

        if (!videoId || videoTitle.includes(' #')) {
            return;
        }

        // Créer l'élément vidéo
        const videoDiv = document.createElement('div');
        videoDiv.classList.add('col-md-4', 'col-xs-6');
        videoDiv.style.backgroundImage = `url(${thumbnailHigh})`;

        videoDiv.innerHTML = `
            <div class="col-xs-12 infoVideo" data-toggle="modal" data-target="#myModal" data-youtube="${videoId}" data-description="${videoDescription}" onclick="modalUpdate(this)">
                <a title="Ouvrir la vidéo dans une nouvelle fenêtre" href="https://www.youtube.com/watch?v=${videoId}" target="_blank" class="physicalLink"><i class="fa fa-external-link"></i></a>
                <i class="fa fa-video-camera"></i>
                <h4 class="videoTitle">${videoTitle}</h4>
            </div>
        `;

        // Ajouter la vidéo au conteneur
        videoContainer.appendChild(videoDiv);
    });
}

async function fetchAllVideos() {
    let loadedCount = 0;
    let pageToken = '';
    let expectedCount = null;

    do {
        const pageUrl = pageToken ? `${API_URL}&pageToken=${pageToken}` : API_URL;
        const response = await fetch(pageUrl);
        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.error && data.error.message ? data.error.message : 'Erreur inconnue lors de la récupération des vidéos');
        }

        const pageItems = data.items || [];
        if (expectedCount === null && data.pageInfo && typeof data.pageInfo.totalResults === 'number') {
            expectedCount = data.pageInfo.totalResults;
        }

        renderVideos(pageItems);
        loadedCount += pageItems.filter(item => item.id && item.id.videoId && !item.snippet.title.includes(' #')).length;
        updateLoadingStatus(loadedCount, expectedCount);
        pageToken = data.nextPageToken || '';
    } while (pageToken);

    hideLoadingStatus();
}

fetchAllVideos()
    .catch(error => {
        console.error('Erreur lors de la récupération des vidéos :', error);
    });

// Au scroll de la page
$(window).scroll(function()
{
    var scrollTop = $(this).scrollTop();
    dynamicBackground(scrollTop);
});

// A l'envoie du message
// $('#msgButton').click(function(){sendMessage();});

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

// function initialisation(){
//     var optionsCarte = {
//         zoom: 14,
//         center:  new google.maps.LatLng(50.2537449, 2.8948495),
//         scrollwheel: false
//     }
//     var maCarte = new google.maps.Map(document.getElementById("map"), optionsCarte);
// }

function modalUpdate(elt){

    var youtube = elt.getAttribute('data-youtube');
    var description = elt.getAttribute('data-description');
    var title = elt.querySelector('.videoTitle').textContent;
    var url = elt.querySelector('a').getAttribute('href');


    $('.embed-responsive-item').attr('src', `https://www.youtube.com/embed/${youtube}`);
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

// function sendMessage()
// {
//     var nom = $('#nom').val();
//     var email = $('#email').val();
//     var website = $('#website').val();
//         website = website != ''  ? website : 'null';
//     var message = $('#message').val();

//     if(nom != '' && email != '' && message != '')
//         $.get( "/home/message/" + nom + "/" + email + "/" + website + "/" + message + "/", function( data ) {
//             sweetAlert('Bonne nouvelle !', 'Le message a bien été envoyé !', 'success');
//         });
// }

// Google Analytics
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-67521657-1', 'auto');
ga('send', 'pageview');


