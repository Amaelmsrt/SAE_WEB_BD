document.addEventListener('DOMContentLoaded', function () {

    // Search
    const searchInput = document.getElementById('search');
    const div = document.getElementById('lesArtistes');

    searchInput.addEventListener('keyup', function () {
        const searchValue = searchInput.value.toLowerCase();

        const artists = div.querySelectorAll('.artiste');
        artists.forEach(function (artist) {
            const artistName = artist.querySelector('.artiste__name').textContent.toLowerCase();
            if (artistName.includes(searchValue)) {
                artist.style.display = 'flex';
            } else {
                artist.style.display = 'none';
            }
        });
    });
});
