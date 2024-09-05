// Remplace ces valeurs par les tiennes
const API_KEY = 'AIzaSyBMtXaOnbCYoM7mdcEoumLBf5gGVAyZ528';
const CHANNEL_ID = 'UCFabwJ1_1dWVDSzWoiAgnJQ';
const MAX_RESULTS = 1000; // Nombre de vidéos à afficher

// URL de l'API YouTube Data
const API_URL = `https://www.googleapis.com/youtube/v3/search?key=${API_KEY}&channelId=${CHANNEL_ID}&part=snippet&order=date&maxResults=${MAX_RESULTS}`;

fetch(API_URL)
    .then(response => response.json())
    .then(data => {
        const videoContainer = document.getElementById('videos');
        data.items.forEach(item => {
            const videoId = item.id.videoId;
            const videoTitle = item.snippet.title;
            const thumbnails = item.snippet.thumbnails;
            const thumbnailDefault = thumbnails.default.url; // 120x90 px
            const thumbnailMedium = thumbnails.medium.url;   // 320x180 px
            const thumbnailHigh = thumbnails.high.url;       // 480x360 px

            // Créer l'élément vidéo
            const videoDiv = document.createElement('div');
            videoDiv.classList.add('col-md-4', 'col-xs-6');
            videoDiv.style.backgroundImage = `url(${thumbnailHigh})`;

            videoDiv.innerHTML = `
                <div class="col-xs-12 infoVideo" data-toggle="modal" data-target="#myModal" data-youtube="${videoId}" data-description="DESCRIPTION">
                    <a title="Ouvrir la vidéo dans une nouvelle fenêtre" href="video/1.html" class="physicalLink"><i class="fa fa-external-link"></i></a>
                    <i class="fa fa-video-camera"></i>
                    <h4 class="videoTitle">${videoTitle}</h4>
                </div>
            `;

            // Ajouter la vidéo au conteneur
            videoContainer.appendChild(videoDiv);
        });
    })
    .catch(error => {
        console.error('Erreur lors de la récupération des vidéos :', error);
    });
