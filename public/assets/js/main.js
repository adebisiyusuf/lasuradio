// main.js

document.addEventListener('DOMContentLoaded', function () {
    // Mobile nav
    var toggle = document.getElementById('menuToggle');
    var nav = document.getElementById('mainNav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            nav.classList.toggle('open');
        });
    }

    // Day tabs for Now Playing
    var tabs = document.querySelectorAll('.day-tab');
    var panels = document.querySelectorAll('.day-panel');

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            var day = tab.getAttribute('data-day');
            tabs.forEach(function (t) { t.classList.remove('active'); });
            panels.forEach(function (p) {
                if (p.getAttribute('data-day') === day) {
                    p.classList.add('active');
                } else {
                    p.classList.remove('active');
                }
            });
            tab.classList.add('active');
        });
    });
});
