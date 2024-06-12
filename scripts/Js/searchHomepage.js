document.getElementById('searchButton').addEventListener('click', function() {
    var searchQuery = document.getElementById('searchQueryInput').value.toLowerCase();
    var annonces = document.querySelectorAll('[data-name]');

    annonces.forEach(function(annonce) {
        var name = annonce.getAttribute('data-name');
        if (name.includes(searchQuery)) {
            annonce.style.display = '';
        } else {
            annonce.style.display = 'none';
        }
    });
});