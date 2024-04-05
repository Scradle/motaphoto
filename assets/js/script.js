/*Gestion de la modale de contact*****************************************************************************/

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('contact-modal');
    var specificLink = document.querySelector('#menu-item-33'); // Sélectionner le lien spécifique par son identifiant

    // Écouter le clic sur le lien spécifique
    specificLink.addEventListener('click', function(event) {
        event.preventDefault(); // Empêcher le comportement par défaut du lien
        modal.style.display = 'block'; // Afficher la modale
    });

    document.addEventListener('wpcf7mailsent', function(event) {
        // Réinitialiser le formulaire après l'envoi réussi
        var formId = ed934cd;
        var form = document.getElementById(formId);
        form.reset();
    }, false);

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


