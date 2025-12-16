// player.js

document.addEventListener('DOMContentLoaded', function () {
    var livePlayer = document.getElementById('livePlayerMain') || document.getElementById('livePlayer');
    var muteBtn = document.getElementById('muteToggle');

    if (livePlayer && muteBtn) {
        muteBtn.addEventListener('click', function () {
            livePlayer.muted = !livePlayer.muted;
            muteBtn.textContent = livePlayer.muted ? 'Unmute' : 'Mute';
        });
    }
});
