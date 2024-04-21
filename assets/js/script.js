/*Gestion de la modale de contact*****************************************************************************/

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('contact-modal');
    var modalVeil = document.querySelector('.modal-veil');
    var modalContent = document.querySelector('.modal-content');
    var specificLink = document.querySelector('.btn-modal'); // Sélectionner le lien spécifique par son identifiant
    var specificMiniLink = document.querySelector('.mini-btn-modal'); 
    var specificBtn = document.querySelector('.single-contact-btn');
    var reference = photo_params.reference;// Récupérer  avec wp_localize
    
    // Écouter le clic sur le lien du menu
    if (specificLink) {
        specificLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêcher le comportement par défaut du lien
            modal.style.display = 'flex'; // Afficher la modale
            modalContent.classList.add('fadeIn');
            setTimeout(function() {
                modalContent.classList.remove('fadeIn');
            }, 1000);
        });
    }

    // Écouter le clic sur le lien du mini menu
    if (specificMiniLink) {
        specificMiniLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêcher le comportement par défaut du lien
            modal.style.display = 'flex'; // Afficher la modale
            modalContent.classList.add('slideIn');
            setTimeout(function() {
                modalContent.classList.remove('slideIn');
            }, 1000);
            });
    }

    // Écouter le clic sur le lien du bouton si .single-contact-btn est présent sur la page
    if (specificBtn) {
        specificBtn.addEventListener('click', function(event) {
            event.preventDefault(); // Empêcher le comportement par défaut du lien
            modal.style.display = 'flex'; // Afficher la modale
            modalContent.classList.add('fadeIn');
            setTimeout(function() {
                modalContent.classList.remove('fadeIn');
            }, 1000);
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

    // Pour fermer la modale avec fade out
    function closeModal() {
        modalVeil.classList.add('fadeOut'); // Ajoute la classe fadeOut
        modalContent.classList.add('fadeOut');
        setTimeout(function() {
            modal.style.display = 'none'; // Cache la modale après la fin de l'animation
            modalVeil.classList.remove('fadeOut'); // Supprime la classe fadeOut pour une utilisation future
            modalContent.classList.remove('fadeOut');
        }, 1000); // Temps d'attente, correspondant à la durée de l'animation en millisecondes
    }


    //  Pour fermer la  mini modal avec slide out
    function closeMiniModal() {
        modalVeil.classList.add('fadeOut'); // Ajoute la classe fadeOut
        modalContent.classList.add('slideOut');
        setTimeout(function() {
            modal.style.display = 'none'; // Cache la modale après la fin de l'animation
            modalVeil.classList.remove('fadeOut'); // Supprime la classe fadeOut pour une utilisation future
            modalContent.classList.remove('slideOut');
        }, 1000); // Temps d'attente, correspondant à la durée de l'animation en millisecondes
    }


    // Écouter le clic en dehors de la modale pour la fermer
    window.addEventListener('click', function(event) {
        if (window.innerWidth < 769 && event.target === modalVeil) {
            closeMiniModal();
        }
        else if (event.target === modalVeil) {
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




/*Gestion de  la modale  pour le mini  menu*****************************************************************************/

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('mini-menu-modal');
    var specificBtn = document.querySelector('.menu-toggle');
    var specificBtnClose = document.querySelector('.menu-toggle-cross');
    var veil = document.querySelector('.mini-menu-veil');
    var miniHead =  document.querySelector('.site-header-mini');
    var miniMenu =  document.querySelector('.mini-navigation');
    var specificMiniLink = document.querySelector('.mini-btn-modal');

    // Écouter le clic sur le lien du bouton si .menu-toggle est présent sur la page
    if (specificBtn) {
        specificBtn.addEventListener('click', function(event) {
            event.preventDefault(); // Empêcher le comportement par défaut du lien
            modal.style.display = 'flex'; // Afficher la modale
        });
    }

    // Pour fermer le menu avec slide out
    function closeMiniMenu() {
        veil.classList.add('slideOut'); // Ajoute la classe fadeOut
        miniMenu.classList.add('slideOut');
        miniHead.classList.add('slideOut');
        setTimeout(function() {
            modal.style.display = 'none'; // Cache la modale après la fin de l'animation
            miniHead.classList.remove('slideOut');
            veil.classList.remove('slideOut'); // Supprime la classe slideOut pour une utilisation future
            miniMenu.classList.remove('slideOut');
        }, 1000); // Temps d'attente, correspondant à la durée de l'animation en millisecondes
    }

    // Écouter le clic sur le lien du bouton si .menu-toggle-cross est présent sur la page
    if (specificBtnClose) {
        specificBtnClose.addEventListener('click', function(event) {
            closeMiniMenu();
        });
    }

    // Écouter le clic sur le lien du bouton si .mini-btn-modal est présent sur la page
    if (specificMiniLink) {
        specificMiniLink.addEventListener('click', function(event) {
            closeMiniMenu();
        });
    }
});
