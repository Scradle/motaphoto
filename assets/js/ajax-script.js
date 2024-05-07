/*Gestion des demandes Ajax*****************************************************************************/

document.addEventListener('DOMContentLoaded', function() {
    var loadMoreBtn = document.querySelector('.load-more-btn');
    var selectDates = document.querySelector('.select-dates');
    var selectCategories = document.querySelector('.select-categories');
    var selectFormats = document.querySelector('.select-formats');
    var currentOffset=0;

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
                    var response = JSON.parse(xhr.responseText);
                    document.querySelector('.photo-gallery').innerHTML += response.html;
                    if (response.have_more_result) {
                    loadMoreBtn.style.display = 'block'; // Cacher le bouton s'il n'y a plus de photos
                    } else {
                        loadMoreBtn.style.display = 'none'; // Cacher le bouton s'il n'y a plus de photos
                    }

                } 
            };
            xhr.send('action=custom_query&orderby=' + selectedOrder + '&category=' + selectedCategory + '&format=' + selectedFormat  + '&offset=' + currentOffset);
        }

        function loadMorePhotos() {
            currentOffset += 8;
            updateGallery();
            
        }

        function handleSelectionChange() {
            document.querySelector('.photo-gallery').innerHTML = '';
            currentOffset = 0;
            updateGallery();
        }
        
        loadMoreBtn.addEventListener('click', loadMorePhotos);
        
        // Sélecteurs à écouter pour les changements
        var selectorsToWatch = [selectDates, selectCategories, selectFormats];
        
        // Ajouter l'événement de changement à chaque sélecteur
        selectorsToWatch.forEach(function(selector) {
            selector.addEventListener('change', handleSelectionChange);
        });
        
    }
});



/**************************************************************************************************************/

