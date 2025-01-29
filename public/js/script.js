/**
 * Met à jour les paramètres de l'URL actuelle en fonction des valeurs passées en argument.
 *
 * @param {Object} params - Un objet contenant les paramètres à mettre à jour.
 */
function updateUrlParam({page, action, id}) {
    // Crée un objet URL basé sur l'URL actuelle de la fenêtre
    let url = new URL(window.location.href);

    // Stocke les valeurs actuelles des paramètres (s'ils existent)
    const currentParams = {};
    if (url.searchParams.has('page')) currentParams.page = url.searchParams.get('page');
    if (url.searchParams.has('action')) currentParams.action = url.searchParams.get('action');
    if (url.searchParams.has('id')) currentParams.id = url.searchParams.get('id');

    // Réinitialise les paramètres de l'URL
    url.search = '';

    // Mise à jour du paramètre "page"
    if (page !== undefined) {
        if (page === true) {
            if (currentParams.page) {
                url.searchParams.set('page', currentParams.page);
            }
        } else {
            url.searchParams.set('page', page);
        }
    }

    // Mise à jour du paramètre "action"
    if (action !== undefined) {
        if (action === true) {
            if (currentParams.action) {
                url.searchParams.set('action', currentParams.action);
            }
        } else {
            url.searchParams.set('action', action);
        }
    }

    // Mise à jour du paramètre "id"
    if (id !== undefined) {
        if (id === true) {
            if (currentParams.id) {
                url.searchParams.set('id', currentParams.id);
            }
        } else {
            url.searchParams.set('id', id);
        }
    }

    // Redirige la page vers la nouvelle URL mise à jour
    window.location.href = url.toString();
}

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

function toggleReviewForm() {
    const formContainer = document.getElementById('review-form-container');
    if (formContainer.classList.contains('show')) {
        formContainer.classList.remove('show');
    } else {
        formContainer.classList.add('show');
    }
}

window.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.Star');
    let selectedRating = 0;

    stars.forEach(star => {
        star.addEventListener('click', () => {
            selectedRating = star.getAttribute('data-value');
            updateStars(selectedRating);
        });

        star.addEventListener('mouseover', () => {
            updateStars(star.getAttribute('data-value'));
        });

        star.addEventListener('mouseout', () => {
            updateStars(selectedRating);
        });
    });

    function updateStars(rating) {
        stars.forEach(star => {
            if (star.getAttribute('data-value') <= rating) {
                star.classList.add('Selected');
            } else {
                star.classList.remove('Selected');
            }
        });
    }


    document.getElementById("review-form")?.addEventListener("submit", function (event) {
        const form = event.target;

        if (form.elements['IdUser'].value === "") {
            event.preventDefault();
            updateUrlParam({page: 'connexion'})
            return;
        }

        if (selectedRating === 0) {
            event.preventDefault();
            alert('Veuillez entrer une note !')
        } else {
            form.elements['note'].value = selectedRating;

            const url = new URL(window.location.href);
            form.action = '?page=' + url.searchParams.get('page') + '&action=ajouter' + '&id=' + url.searchParams.get('id');
        }
    });
})
