/*Gestion des demandes Ajax***************************************************************************/

// Déclaration des variables globales pour les boutons et les sélecteurs
var loadMoreBtn;
var selectCategories;
var selectFormats;
var currentOffset = 0;
var selectDates;

// Ajout d'un écouteur d'événement qui se déclenche lorsque le DOM est complètement chargé
document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des variables en sélectionnant les éléments du DOM
    loadMoreBtn = document.querySelector('.load-more-btn');
    selectDates = document.querySelector('.select-dates');
    selectCategories = document.querySelector('.select-categories');
    selectFormats = document.querySelector('.select-formats');

    // Vérification que les sélecteurs existent avant d'ajouter des écouteurs d'événements
    if (selectDates && selectCategories && selectFormats) {

        // Ajout d'un écouteur d'événement au bouton "load more" pour charger plus de photos
        loadMoreBtn.addEventListener('click', loadMorePhotos);

        // Création d'un tableau contenant tous les sélecteurs à surveiller
        var selectorsToWatch = [selectDates, selectCategories, selectFormats];

        // Pour chaque sélecteur, ajout d'un écouteur d'événement qui se déclenche lors d'un changement
        selectorsToWatch.forEach(function(selector) {
            selector.addEventListener('change', handleSelectionChange);
        });
    }
});

// Fonction pour mettre à jour la galerie avec les nouvelles sélections ou le chargement de plus de photos
function updateGallery() {
    // Récupération des valeurs sélectionnées pour l'ordre, la catégorie et le format
    var selectedOrder = selectDates.value;
    var selectedCategory = selectCategories.value;
    var selectedFormat = selectFormats.value;

    // Construction de l'URL pour la requête AJAX
    const url = script_params.websiteurl + '/wp-json/custom/v1/query/';

    // Envoi d'une requête AJAX avec les paramètres sélectionnés
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            orderby: selectedOrder,
            category: selectedCategory,
            format: selectedFormat,
            offset: currentOffset
        })
    })
    .then(response => response.json())
    .then(data => {
        // Ajout des nouvelles photos à la galerie
        document.querySelector('.photo-gallery').innerHTML += data.html;
        // Affichage ou masquage du bouton "load more" en fonction des résultats
        if (data.have_more_result) {
            loadMoreBtn.style.display = 'block';
        } else {
            loadMoreBtn.style.display = 'none';
        }
    })
    .catch(error => console.error('Erreur lors de la mise à jour de la galerie :', error));
}

// Fonction pour charger plus de photos lorsque le bouton "load more" est cliqué
function loadMorePhotos() {
    // Incrémentation de l'offset pour charger les photos suivantes
    currentOffset += 8;
    // Appel de la fonction de mise à jour de la galerie
    updateGallery();
}

// Fonction qui réinitialise la galerie et recharge les photos lors d'un changement de sélection
function handleSelectionChange() {
    // Vidage de la galerie actuelle
    document.querySelector('.photo-gallery').innerHTML = '';
    // Réinitialisation de l'offset à zéro
    currentOffset = 0;
    // Appel de la fonction de mise à jour de la galerie
    updateGallery();
}
