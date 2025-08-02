const ytVideosToEmbed = document.querySelectorAll(".yt-video-embed");

if (ytVideosToEmbed.length) {
    var yTtag = document.createElement('script');

    yTtag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(yTtag, firstScriptTag);
}

const players = [];

function onYouTubeIframeAPIReady() {
    let player;

    ytVideosToEmbed.forEach(ytVideo => {
        let videoId = ytVideo.dataset.youtubeId;

        player = new YT.Player(ytVideo, {
            height: '390',
            width: '640',
            videoId: videoId,
            playerVars: {
                'playsinline': 1,
                'loop': 1,
                'mute': 0,
                'controls': 0,
                'playlist': videoId
            },
            events: {
                'onReady': onPlayerReady
            }
        });

        players.push(player);
    });
}

function onPlayerReady(event) {
    const player = event.target
    const videoId = event.target.options.videoId;
    const playBtn = document.querySelector("[data-for-video='" + videoId + "']");

    playBtn.addEventListener('click', function() {
        player.playVideo();
    });
}
