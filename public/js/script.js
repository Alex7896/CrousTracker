function updateUrlParam(param, value) {
    let url = new URL(window.location.href);
    url.searchParams.set(param, value);
    window.location.href = url;
}

document.addEventListener('DOMContentLoaded', () => {
    var map = L.map('map').setView([45.77866149222399, 4.872053750875164], 15);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
});