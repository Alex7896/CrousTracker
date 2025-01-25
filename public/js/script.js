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

document.addEventListener('DOMContentLoaded', () => {
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
});
