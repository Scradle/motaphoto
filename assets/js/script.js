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

/*Gestion de la lightbox*********************************************************************************/

document.addEventListener('click', function(event) {
    if (event.target.classList.contains('img-icon-fullscreen')) {
        var imgHoverbox = event.target.closest('.img-hoverbox');
        var imageUrl = imgHoverbox.dataset.imageUrl;
        var imageTitle = imgHoverbox.dataset.imageTitle;
        var imageCategory = imgHoverbox.dataset.imageCategory;

        // Ouvrir la lightbox avec l'URL de l'image et ses informations
        openLightbox(imageUrl, imageTitle, imageCategory);
    }

    // Fermer la lightbox en cliquant sur la croix
    if (event.target.classList.contains('lightbox-toggle-cross')) {
        closeLightbox();
    }
});

function openLightbox(imageUrl, imageTitle, imageCategory) {
    // indexation de  toutes les images  dans la  div
    var imagesInSameDiv = document.querySelectorAll('.photo-div');
    var currentIndex = 0;

    // Afficher des informations sur les images dans la console
    console.log("Nombre d'images trouvées dans la même div:", imagesInSameDiv.length);
    imagesInSameDiv.forEach(function(image, index) {
        console.log("Image", index + 1, "URL:", image.src);
    });

    // Trouver l'index de l'image actuellement affichée
    for (var i = 0; i < imagesInSameDiv.length; i++) {
        if (imagesInSameDiv[i].src === imageUrl) {
            currentIndex = i;
            break;
        }
    }

    // Afficher des informations sur l'image actuellement affichée dans la console
    console.log("Index de l'image actuellement affichée:", currentIndex);
    console.log("URL de l'image actuellement affichée:", imageUrl);

    // Code pour ouvrir la lightbox avec l'URL de l'image stockée dans img-hoverbox
    var lightboxContent = document.querySelector('.lightbox-img-div');
    lightboxContent.innerHTML = '<img src="' + imageUrl + '" alt="Photo">';
    var lightbox = document.getElementById('lightbox');
    lightbox.style.display = 'flex';

    // Afficher les informations de l'image dans lightbox-info
    var lightboxInfo = document.querySelector('.lightbox-info');
    lightboxInfo.innerHTML = '<div class="lightbox-img-title">' + imageTitle + '</div>' +
                             '<div class="lightbox-img-category">' + imageCategory + '</div>';

    // Ajouter des écouteurs d'événements pour les boutons "prev" et "next"
    document.querySelector('.lightbox-prev').addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + imagesInSameDiv.length) % imagesInSameDiv.length;
        showImage(imagesInSameDiv[currentIndex]);
    });

    document.querySelector('.lightbox-next').addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % imagesInSameDiv.length;
        showImage(imagesInSameDiv[currentIndex]);
    });
}

// Fonction pour afficher une image dans la lightbox
function showImage(image, currentIndex) {
    var lightboxContent = document.querySelector('.lightbox-img-div');
    lightboxContent.innerHTML = '<img src="' + image.src + '" alt="Photo">';
}

// fermeture de la lightbox
function closeLightbox() {
    var lightbox = document.getElementById('lightbox');
    lightbox.style.display = 'none';
}
