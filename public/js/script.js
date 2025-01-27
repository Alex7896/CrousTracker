function updateUrlParam({page, action, id}) {
    let url = new URL(window.location.href);

    const currentParams = {};
    if (url.searchParams.has('page')) currentParams.page = url.searchParams.get('page');
    if (url.searchParams.has('action')) currentParams.action = url.searchParams.get('action');
    if (url.searchParams.has('id')) currentParams.id = url.searchParams.get('id');

    url.search = '';
    if (page !== undefined) {
        if (page === true) {
            if (currentParams.page) {
                url.searchParams.set('page', currentParams.page);
            }
        } else {
            url.searchParams.set('page', page);
        }
    }

    if (action !== undefined) {
        if (action === true) {
            if (currentParams.action) {
                url.searchParams.set('action', currentParams.action);
            }
        } else {
            url.searchParams.set('action', action);
        }
    }

    if (id !== undefined) {
        if (id === true) {
            if (currentParams.id) {
                url.searchParams.set('id', currentParams.id);
            }
        } else {
            url.searchParams.set('id', id);
        }
    }
    window.location.href = url.toString();
}


document.addEventListener('DOMContentLoaded', async () => {
    // Initialisation de la carte centrée sur une position par défaut
    const map = L.map('map').setView([45.77866149222399, 4.872053750875164], 15);

    // Définir une icône personnalisée pour les marqueurs
    const redIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
        shadowSize: [41, 41],
    });

    // Ajouter le fond de carte OpenStreetMap
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);

    // Fonction pour récupérer les données des CROUS depuis l'API PHP
    async function fetchCrousLocations() {
        try {
            const response = await fetch('./get_crous_locations.php'); // Adapter l'URL si nécessaire
            if (!response.ok) {
                throw new Error("Erreur lors de la récupération des données.");
            }

            const locations = await response.json();
            return locations;
        } catch (error) {
            console.error("Erreur lors de la récupération des données des CROUS :", error);
            return [];
        }
    }

    // Ajouter les marqueurs sur la carte en fonction des données récupérées
    async function addCrousMarkers() {

    }

    // Appeler la fonction pour ajouter les marqueurs
    addCrousMarkers();
});

// Fonctionnalité pour agrandir/réduire la barre latérale
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
    if (localStorage.getItem('navBar') === 'reduit') {
        reduire();
    } else {
        agrandir();
    }
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
    if (localStorage.getItem('navBar') === 'reduit') {
        reduire();
    } else {
        agrandir();
    }
})