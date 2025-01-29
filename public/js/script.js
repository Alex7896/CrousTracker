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

// Fonction pour agrandir la barre latérale
function agrandir() {
    document.querySelector(".sidebar-navbar")?.classList.remove("reduit");
    document.getElementById("icon_droite")?.classList.add("actif");
    document.getElementById("icon_gauche")?.classList.remove("actif");
    localStorage.setItem('navBar', 'agrandit');
}

// Fonction pour réduire la barre latérale
function reduire() {
    document.querySelector(".sidebar-navbar")?.classList.add("reduit");
    document.getElementById("icon_gauche")?.classList.add("actif");
    document.getElementById("icon_droite")?.classList.remove("actif");
    localStorage.setItem('navBar', 'reduit');
}

// Au chargement de la page, applique l'état de la barre latérale en fonction du localStorage
window.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('navBar') === 'reduit') {
        reduire();
    } else {
        agrandir();
    }
})

// Fonction pour afficher ou masquer le formulaire d'ajout d'avis
function toggleReviewForm() {
    const formContainer = document.getElementById('review-form-container');
    if (formContainer.classList.contains('show')) {
        formContainer.classList.remove('show');
    } else {
        formContainer.classList.add('show');
    }
}

// Au chargement de la page, gère les étoiles de notation pour la page d'ajout d'avis
window.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.Star');
    let selectedRating = 0; // Stocke la note sélectionnée

    // Ajoute des événements sur chaque étoile
    stars.forEach(star => {
        // Sélectionne une note au clic
        star.addEventListener('click', () => {
            selectedRating = star.getAttribute('data-value');
            updateStars(selectedRating);
        });

        // Effet au survol : met en surbrillance les étoiles jusqu'à celle survolée
        star.addEventListener('mouseover', () => {
            updateStars(star.getAttribute('data-value'));
        });

        // Effet à la sortie de la souris : rétablit la note sélectionnée
        star.addEventListener('mouseout', () => {
            updateStars(selectedRating);
        });
    });

    // Fonction pour mettre à jour l'affichage des étoiles en fonction de la note donnée
    function updateStars(rating) {
        stars.forEach(star => {
            if (star.getAttribute('data-value') <= rating) {
                star.classList.add('Selected');
            } else {
                star.classList.remove('Selected');
            }
        });
    }

    // Gère la soumission du formulaire d'avis
    document.getElementById("review-form")?.addEventListener("submit", function (event) {
        const form = event.target;

        // Vérifie si l'utilisateur est connecté en s'assurant que "IdUser" n'est pas vide
        if (form.elements['IdUser'].value === "") {
            event.preventDefault(); // Empêche l'envoi du formulaire
            updateUrlParam({page: 'connexion'})
            return;
        }

        // Vérifie si une note a été sélectionnée avant d'envoyer le formulaire
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
