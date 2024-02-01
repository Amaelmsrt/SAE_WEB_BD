document.addEventListener('DOMContentLoaded', function () {
    const likeBtn = document.getElementById('likeArtiste');
    const likeBtn2 = document.getElementById('likeAlbum');

    likeBtn.addEventListener('click', function () {
        const artisteId = likeBtn.getAttribute('data-id-artiste');
        const idUtilisateur = likeBtn.getAttribute('data-id');

        fetch('/controlleurApi.php/likeArtiste/' + artisteId + '/' + idUtilisateur, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function (data) {
            if (data.like == true) {
                likeBtn.classList.add('liked');
            } else {
                likeBtn.classList.remove('liked');
            }
        })
        .catch(function (error) {
            console.error('Fetch error:', error);
        });
    });

    likeBtn2.addEventListener('click', function () {
        const albumId = likeBtn2.getAttribute('data-id-album');
        const idUtilisateur = likeBtn2.getAttribute('data-id');

        fetch('/controlleurApi.php/likeAlbum/' + albumId + '/' + idUtilisateur, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function (data) {
            if (data.like == true) {
                likeBtn2.classList.add('liked');
            } else {
                likeBtn2.classList.remove('liked');
            }
        })
        .catch(function (error) {
            console.error('Fetch error:', error);
        });
    });
});
