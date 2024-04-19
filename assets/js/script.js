/*Gestion de la modale de contact*****************************************************************************/

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('contact-modal');
    var specificLink = document.querySelector('.btn-modale'); // Sélectionner le lien spécifique par son identifiant
    var specificBtn = document.querySelector('.single-contact-btn');
    var reference = photo_params.reference;// Récupérer  avec wp_localize

    // Écouter le clic sur le lien du menu
    specificLink.addEventListener('click', function(event) {
        event.preventDefault(); // Empêcher le comportement par défaut du lien
        modal.style.display = 'block'; // Afficher la modale
    });

    // Écouter le clic sur le lien du bouton si .single-contact-btn est présent sur la page
    if (specificBtn) {
        specificBtn.addEventListener('click', function(event) {
            event.preventDefault(); // Empêcher le comportement par défaut du lien
            modal.style.display = 'block'; // Afficher la modale
            var elements = document.querySelectorAll('.wpcf7-form-control');
            // Vérifiez s'il existe au moins trois éléments avec cette classe
            if (elements.length >= 3) {
                // Sélectionnez le troisième élément (index 2 car les index commencent à 0)
                var troisiemeElement = elements[2];
                // Remplir la référence du formulaire
                troisiemeElement.value = reference;
            }
        });
    }

    // JavaScript pour fermer la modale avec fade out
    function closeModal() {
        var modal = document.getElementById('contact-modal');
        modal.classList.add('fadeOut'); // Ajoute la classe fadeOut
        setTimeout(function() {
            modal.style.display = 'none'; // Cache la modale après la fin de l'animation
            modal.classList.remove('fadeOut'); // Supprime la classe fadeOut pour une utilisation future
        }, 1000); // Temps d'attente, correspondant à la durée de l'animation en millisecondes
    }

    // Écouter le clic en dehors de la modale pour la fermer
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            closeModal();
        }
    });
});

/*Gestion des demandes Ajax*****************************************************************************/

// Charger  plus  d'image  sur  front-page  à l'appui  sur le bouton
document.addEventListener('DOMContentLoaded', function() {
    var loadMoreBtn = document.querySelector('.load-more-btn');
    if (loadMoreBtn) {
        var offset = 8; // Offset initial

        // Fonction pour obtenir le nombre total d'images
        function getTotalPhotoCount(callback) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', script_params.ajaxurl + '?action=get_total_photo_count', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var totalImages = response.data;
                        callback(totalImages);
                    }
                }
            };
            xhr.send();
        }

        // Charger le nombre total d'images au chargement de la page
        getTotalPhotoCount(function(totalImages) {
            // Vérifier si le bouton doit être caché au chargement de la page
            if (offset >= totalImages) {
                loadMoreBtn.style.display = 'none'; // Cacher le bouton s'il n'y a plus de photos
            }
        });

        loadMoreBtn.addEventListener('click', function() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', script_params.ajaxurl, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = xhr.responseText;
                    document.querySelector('.single-gallery').insertAdjacentHTML('beforeend', response);
                    offset += 8; // Incrémenter l'offset pour les prochaines photos

                    // Charger le nombre total d'images à nouveau
                    getTotalPhotoCount(function(totalImages) {
                        // Vérifier s'il reste des photos à charger
                        if (offset >= totalImages) {
                            loadMoreBtn.style.display = 'none'; // Cacher le bouton s'il n'y a plus de photos
                        }
                    });
                }
            };
            xhr.send('action=load_more_photos&offset=' + offset);
        });
    }
});





