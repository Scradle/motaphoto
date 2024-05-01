/*Gestion des demandes Ajax*****************************************************************************/

// Charger  plus  d'image  sur  front-page  à l'appui  sur le bouton si aucun select n'est utilisé
// document.addEventListener('DOMContentLoaded', function() {
//     var loadMoreBtn = document.querySelector('.load-more-btn');
//     if (loadMoreBtn) {
//         var offset = 8; // Offset initial

//         // Fonction pour obtenir le nombre total d'images
//         function getTotalPhotoCount(callback) {
//             var xhr = new XMLHttpRequest();
//             xhr.open('GET', script_params.ajaxurl + '?action=get_total_photo_count', true);
//             xhr.setRequestHeader('Content-Type', 'application/json');
//             xhr.onreadystatechange = function() {
//                 if (xhr.readyState === 4 && xhr.status === 200) {
//                     var response = JSON.parse(xhr.responseText);
//                     if (response.success) {
//                         var totalImages = response.data;
//                         callback(totalImages);
//                     }
//                 }
//             };
//             xhr.send();
//         }
//         // Charger le nombre total d'images au chargement de la page
//         getTotalPhotoCount(function(totalImages) {
//             // Vérifier si le bouton doit être caché au chargement de la page
//             if (offset >= totalImages) {
//                 loadMoreBtn.style.display = 'none'; // Cacher le bouton s'il n'y a plus de photos
//             }
//         });

//         loadMoreBtn.addEventListener('click', function() {

//             var category = document.querySelector('.select-categories').value;
//             var format = document.querySelector('.select-formats').value;
//             var date = document.querySelector('.select-dates').value;

//             var xhr = new XMLHttpRequest();
//             xhr.open('POST', script_params.ajaxurl, true);
//             xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//             xhr.onreadystatechange = function() {
//                 if (xhr.readyState === 4 && xhr.status === 200) {
//                     var response = xhr.responseText;
//                     document.querySelector('.photo-gallery').insertAdjacentHTML('beforeend', response);
//                     offset += 8; // Incrémenter l'offset pour les prochaines photos

//                     // Charger le nombre total d'images à nouveau
//                     getTotalPhotoCount(function(totalImages) {
//                         // Vérifier s'il reste des photos à charger
//                         if (offset >= totalImages) {
//                             loadMoreBtn.style.display = 'none'; // Cacher le bouton s'il n'y a plus de photos
//                         }
//                     });
//                 }
//             };
//             xhr.send('action=load_more_photos&offset=' + offset + '&category=' + category + '&format=' + format + '&date=' + date);
//         });
//     }
// });


/*Gestion des selects*********************************************************************************/

//tri par categorie format et order by
document.addEventListener('DOMContentLoaded', function() {
    var selectDates = document.querySelector('.select-dates');
    var selectCategories = document.querySelector('.select-categories');
    var selectFormats = document.querySelector('.select-formats');

    if (selectDates && selectCategories && selectFormats) {
        function updateGallery() {
            var selectedOrder = selectDates.value;
            var selectedCategory = selectCategories.value;
            var selectedFormat = selectFormats.value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', script_params.ajaxurl);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.querySelector('.photo-gallery').innerHTML = xhr.responseText;
                }
                else {
                    console.log('Request failed. Returned status of ' + xhr.status);
                }
            };
            xhr.send('action=custom_query&orderby=' + selectedOrder + '&category=' + selectedCategory + '&format=' + selectedFormat);
        }

        selectDates.addEventListener('change', updateGallery);
        selectCategories.addEventListener('change', updateGallery);
        selectFormats.addEventListener('change', updateGallery);
    }
});


/**************************************************************************************************************/

