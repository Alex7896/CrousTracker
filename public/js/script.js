function updateUrlParam(param, value) {
    let url = new URL(window.location.href);
    url.searchParams.set(param, value);
    window.location.href = url;
}

document.addEventListener('DOMContentLoaded', () => {
    var map = L.map('map').setView([45.77866149222399, 4.872053750875164], 15);


    // pour modif l'icon
    var redIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
        shadowSize: [41, 41]
    });
    //pour ajouter un ping
    var marker = L.marker([45.778796,4.871728],
        { icon: redIcon}).addTo(map);// là c'est l'adresse du crous la doua mais faudra for le bordel

    //pour ajouter le msg en haut du ping
    marker.bindPopup("<a href='http://localhost'> world!</a><br>I am a popup.").openPopup();



    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);


});

/*document.addEventListener('DOMContentLoaded', () => {
    // Fonction pour mettre à jour le titre de la page en fonction du paramètre 'page'
    function updateTitle(page) {
        let pageTitle = '';

        switch(page) {
            case 'menu':
                pageTitle = 'Menu - MonCrous';
                break;
            case 'details':
                pageTitle = 'Détails - MonCrous';
                break;
            case 'avis':
                pageTitle = 'Avis - MonCrous';
                break;
            default:
                pageTitle = 'MonCrous';
                break;
        }

        document.title = pageTitle; // Mise à jour du titre
    }

    // Lorsque la page est chargée, on récupère le paramètre 'page' de l'URL et on met à jour le titre
    const page = new URLSearchParams(window.location.search).get('page');
    if (page) {
        updateTitle(page);
    }

    // Ajoute un event listener pour détecter les changements d'URL via updateUrlParam
    window.addEventListener('popstate', () => {
        const page = new URLSearchParams(window.location.search).get('page');
        if (page) {
            updateTitle(page);
        }
    });
});*/

function agrandir() {
    document.querySelector(".sidebar-navbar")?.classList.remove("reduit");
    document.getElementById("icon_droite")?.classList.add("actif");
    document.getElementById("icon_gauche")?.classList.remove("actif");
    localStorage.setItem('navBar', 'agrandit');
}

function reduire() {
    document.querySelector(".sidebar-navbar")?.classList.add("reduit");
    document.getElementById("icon_gauche")?.classList.add("actif");
    document.getElementById("icon_droite")?.classList.remove("actif");
    localStorage.setItem('navBar', 'reduit');
}
window.addEventListener('DOMContentLoaded', () => {
    if(localStorage.getItem('navBar')==='reduit'){
        reduire();
    } else {
        agrandir();
    }
})