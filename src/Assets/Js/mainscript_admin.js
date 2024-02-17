const activeSquare = document.querySelector("#activeSquare");
const goToMenuPrincipal = document.querySelector("#goToMenuPrincipal");
const goToArtistes = document.querySelector("#goToArtistes");
const goToSons = document.querySelector("#goToSons");
const goToGenres = document.querySelector("#goToGenres");
const goToUtilisateurs = document.querySelector("#goToUtilisateurs");
const goToPlaylists = document.querySelector("#goToPlaylists");
const goToAlbums = document.querySelector("#goToAlbums");

const sectionMenuPrincipal = document.querySelector("#pagePrincipale");
const sectionMenuArtistes = document.querySelector("#pageArtistes");
const sectionMenuSons = document.querySelector("#pageSons");
const sectionMenuGenres = document.querySelector("#pageGenres");
const sectionMenuUtilisateurs = document.querySelector("#pageUtilisateurs");
const sectionMenuPlaylists = document.querySelector("#pagePlaylists");
const sectionMenuAlbums = document.querySelector("#pageAlbums");

const btnMenuArtistes = document.querySelector("#btnMenuArtistes");
const btnMenuSons = document.querySelector("#btnMenuSons");
const btnMenuGenres = document.querySelector("#btnMenuGenres");
const btnMenuUtilisateurs = document.querySelector("#btnMenuUtilisateurs");
const btnMenuPlaylists = document.querySelector("#btnMenuPlaylists");
const btnMenuAlbums = document.querySelector("#btnMenuAlbums");

const sections = [
    document.querySelector("#pagePrincipale"),
    document.querySelector("#pageArtistes"),
    document.querySelector("#pageSons"),
    document.querySelector("#pageGenres"),
    document.querySelector("#pageUtilisateurs"),
    document.querySelector("#pagePlaylists"),
    document.querySelector("#pageAlbums")
];

const menuItems = [goToMenuPrincipal, goToArtistes, goToSons, goToGenres, goToUtilisateurs, goToPlaylists, goToAlbums];


function changeCurrentMenu(e, index) {
    e?.preventDefault();

    const curIndex = sections.findIndex(section => section.classList.contains('active-section'));

    const menuItemHeight = 3.5;
    const menuItemMargin = 0.85;
    const startPosition = 1;
    const position = startPosition + index * (menuItemHeight + menuItemMargin);

    gsap.to(activeSquare, { top: `${position}rem`, duration: 0.6, ease: "power4.out" });

    menuItems.forEach((menuItem, i) => {
        gsap.to(menuItem, { color: i === index ? "#0E100F" : "#FEFCE1", duration: 0.6, ease: "power4.out" });
    });

    sections.forEach((section, i) => {
        gsap.to(section, { opacity: i === index ? 1 : 0, y: i === index ? 0 : (i < index ? "100vw" : "-100vw"), duration: 0.6, zIndex: i === index ? 1 : -1, ease: "power4.out" });
        section.classList.toggle('active-section', i === index);
    });

    localStorage.setItem('currentSectionIndex', index.toString());
}

function loadActiveSection() {
    const sectionIndex = localStorage.getItem('currentSectionIndex');
    changeCurrentMenu(null, sectionIndex ? parseInt(sectionIndex) : 0);
}

window.addEventListener('DOMContentLoaded', loadActiveSection);

menuItems.forEach((menuItem, index) => {
    menuItem.addEventListener('click', (e) => changeCurrentMenu(e, index));
});

goToMenuPrincipal.addEventListener('click', (e) => changeCurrentMenu(e,0));
goToArtistes.addEventListener('click', (e) => changeCurrentMenu(e,1));
goToSons.addEventListener('click', (e) => changeCurrentMenu(e,2));
goToGenres.addEventListener('click', (e) => changeCurrentMenu(e,3));
goToUtilisateurs.addEventListener('click', (e) => changeCurrentMenu(e,4));
goToPlaylists.addEventListener('click', (e) => changeCurrentMenu(e,5));
goToAlbums.addEventListener('click', (e) => changeCurrentMenu(e,6));

function clearActiveSections() {
    if (sectionMenuPrincipal.classList != null)
        sectionMenuPrincipal.classList.remove("active-section");
    if (sectionMenuSons.classList != null)
        sectionMenuSons.classList.remove("active-section");
    if (sectionMenuGenres.classList != null)
        sectionMenuGenres.classList.remove("active-section");
    if (sectionMenuUtilisateurs.classList != null)
        sectionMenuUtilisateurs.classList.remove("active-section");
    if (sectionMenuPlaylists.classList != null)
        sectionMenuPlaylists.classList.remove("active-section");
    if (sectionMenuAlbums.classList != null)
        sectionMenuAlbums.classList.remove("active-section");
}

function showPageArtistes() {
    sectionMenuArtistes.style.display ="flex";
    
    setTimeout(() => {
        sectionMenuPrincipal.style.display = "none";
        sectionMenuSons.style.display = "none";
        sectionMenuGenres.style.display = "none";
        sectionMenuUtilisateurs.style.display = "none";
        sectionMenuPlaylists.style.display = "none";
        sectionMenuAlbums.style.display = "none";
    }, 500);

}

function showPageSons() {
    sectionMenuSons.style.display ="flex";

    gsap.fromTo(sectionMenuSons, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.6, delay:0.4,ease:"power4.out"});
    gsap.to(sectionMenuArtistes, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuGenres, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuUtilisateurs, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuPlaylists, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuAlbums, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});

    setTimeout(() => {
        sectionMenuPrincipal.style.display = "none";
        sectionMenuArtistes.style.display = "none";
        sectionMenuGenres.style.display = "none";
        sectionMenuUtilisateurs.style.display = "none";
        sectionMenuPlaylists.style.display = "none";
        sectionMenuAlbums.style.display = "none";
    }, 500);
}

function showPageGenres() {
    sectionMenuGenres.style.display ="flex";

    gsap.fromTo(sectionMenuGenres, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.6, delay:0.4,ease:"power4.out"});
    gsap.to(sectionMenuArtistes, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuSons, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuUtilisateurs, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuPlaylists, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuAlbums, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});

    setTimeout(() => {
        sectionMenuPrincipal.style.display = "none";
        sectionMenuArtistes.style.display = "none";
        sectionMenuSons.style.display = "none";
        sectionMenuUtilisateurs.style.display = "none";
        sectionMenuPlaylists.style.display = "none";
        sectionMenuAlbums.style.display = "none";
    }, 500);
}

function showPageUtilisateurs() {
    sectionMenuUtilisateurs.style.display ="flex";

    gsap.fromTo(sectionMenuUtilisateurs, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.6, delay:0.4,ease:"power4.out"});
    gsap.to(sectionMenuArtistes, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuSons, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuGenres, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuPlaylists, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuAlbums, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});

    setTimeout(() => {
        sectionMenuPrincipal.style.display = "none";
        sectionMenuArtistes.style.display = "none";
        sectionMenuSons.style.display = "none";
        sectionMenuGenres.style.display = "none";
        sectionMenuPlaylists.style.display = "none";
        sectionMenuAlbums.style.display = "none";
    }, 500);
}

function showPagePlaylists() {
    sectionMenuPlaylists.style.display ="flex";

    gsap.fromTo(sectionMenuPlaylists, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.6, delay:0.4,ease:"power4.out"});
    gsap.to(sectionMenuArtistes, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuSons, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuGenres, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuUtilisateurs, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuAlbums, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});

    setTimeout(() => {
        sectionMenuPrincipal.style.display = "none";
        sectionMenuArtistes.style.display = "none";
        sectionMenuSons.style.display = "none";
        sectionMenuGenres.style.display = "none";
        sectionMenuUtilisateurs.style.display = "none";
        sectionMenuAlbums.style.display = "none";
    }, 500);
}

function showPageAlbums() {
    sectionMenuAlbums.style.display ="flex";

    gsap.fromTo(sectionMenuAlbums, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.6, delay:0.4,ease:"power4.out"});
    gsap.to(sectionMenuArtistes, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuSons, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuGenres, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuUtilisateurs, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});
    gsap.to(sectionMenuPlaylists, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"});

    setTimeout(() => {
        sectionMenuPrincipal.style.display = "none";
        sectionMenuArtistes.style.display = "none";
        sectionMenuSons.style.display = "none";
        sectionMenuGenres.style.display = "none";
        sectionMenuUtilisateurs.style.display = "none";
        sectionMenuPlaylists.style.display = "none";
    }, 500);
}



btnMenuArtistes.addEventListener('click', showPageArtistes);
btnMenuSons.addEventListener('click', showPageSons);
btnMenuGenres.addEventListener('click', showPageGenres);
btnMenuUtilisateurs.addEventListener('click', showPageUtilisateurs);
btnMenuPlaylists.addEventListener('click', showPagePlaylists);
btnMenuAlbums.addEventListener('click', showPageAlbums);

// Partie pour les modales

let btnClose = document.querySelectorAll(".close-button");

btnClose.forEach(function(btn) {
    btn.onclick = function() {
        btn.closest(".modal").style.display = "none";
    };
});

window.onclick = function(event) {
    if (event.target.classList.contains("modal")) {
        event.target.style.display = "none";
    }
};

// Artistes

let modalAjouterArtiste = document.querySelector("#modal-ajouterArtiste");
let modalConsulterArtiste = document.querySelector("#modal-consulterArtiste");
let modalSupprimerArtiste = document.querySelector("#modal-supprimerArtiste");

document.querySelector("#btn-ajouterArtiste").onclick = function() {
    modalAjouterArtiste.style.display = "block";
}

document.querySelectorAll(".btn-supprimerArtiste").forEach(function(btn) {
    btn.onclick = function() {
        document.querySelector("#id_artiste_supprimer").value = btn.getAttribute("data-idArtiste");
        modalSupprimerArtiste.style.display = "block";
    };
});

document.querySelectorAll(".btn-consulterArtiste").forEach(function(btn) {
    btn.onclick = function() {
        document.querySelector("#id_modif_artiste").value = btn.getAttribute("data-idArtiste");
        document.querySelector("#nom_modif_artiste").value = btn.getAttribute("data-nomArtiste");
        modalConsulterArtiste.style.display = "block";
    };
});

// Genres

let modalAjouterGenre = document.querySelector("#modal-ajouterGenre");
let modalConsulterGenre = document.querySelector("#modal-consulterGenre");
let modalSupprimerGenre = document.querySelector("#modal-supprimerGenre");

document.querySelector("#btn-ajouterGenre").onclick = function() {
    modalAjouterGenre.style.display = "block";
}

document.querySelectorAll(".btn-supprimerGenre").forEach(function(btn) {
    btn.onclick = function() {
        document.querySelector("#id_genre_supprimer").value = btn.getAttribute("data-idGenre");
        modalSupprimerGenre.style.display = "block";
    };
});

document.querySelectorAll(".btn-consulterGenre").forEach(function(btn) {
    btn.onclick = function() {
        document.querySelector("#id_modif_genre").value = btn.getAttribute("data-idGenre");
        document.querySelector("#titre_modif_genre").value = btn.getAttribute("data-titreGenre");
        modalConsulterGenre.style.display = "block";
    };
});

// Utilisateurs

let modalAjouterUtilisateur = document.querySelector("#modal-ajouterUtilisateur");
let modalConsulterUtilisateur = document.querySelector("#modal-consulterUtilisateur");
let modalSupprimerUtilisateur = document.querySelector("#modal-supprimerUtilisateur");

document.querySelector("#btn-ajouterUtilisateur").onclick = function() {
    modalAjouterUtilisateur.style.display = "block";
}

document.querySelectorAll(".btn-supprimerUtilisateur").forEach(function(btn) {
    btn.onclick = function() {
        document.querySelector("#id_utilisateur_supprimer").value = btn.getAttribute("data-idUtilisateur");
        modalSupprimerUtilisateur.style.display = "block";
    };
});

document.querySelectorAll(".btn-consulterUtilisateur").forEach(function(btn) {
    btn.onclick = function() {
        document.querySelector("#id_modif_utilisateur").value = btn.getAttribute("data-idUtilisateur");
        document.querySelector("#nom_modif_utilisateur").value = btn.getAttribute("data-nomUtilisateur");
        document.querySelector("#prenom_modif_utilisateur").value = btn.getAttribute("data-prenomUtilisateur");
        document.querySelector("#pseudo_modif_utilisateur").value = btn.getAttribute("data-pseudoUtilisateur");
        document.querySelector("#email_modif_utilisateur").value = btn.getAttribute("data-emailUtilisateur");
        document.querySelector("#mdp_modif_utilisateur").value = btn.getAttribute("data-mdpUtilisateur");
        document.querySelector("#statut_modif_utilisateur").value = btn.getAttribute("data-statutUtilisateur");
        modalConsulterUtilisateur.style.display = "block";
    };
});

// Playlists

let modalAjouterPlaylist = document.querySelector("#modal-ajouterPlaylist");
let modalConsulterPlaylist = document.querySelector("#modal-consulterPlaylist");
let modalSupprimerPlaylist = document.querySelector("#modal-supprimerPlaylist");

document.querySelector("#btn-ajouterPlaylist").onclick = function() {
    modalAjouterPlaylist.style.display = "block";
}

document.querySelectorAll(".btn-supprimerPlaylist").forEach(function(btn) {
    btn.onclick = function() {
        document.querySelector("#id_playlist_supprimer").value = btn.getAttribute("data-idPlaylist");
        modalSupprimerPlaylist.style.display = "block";
    };
});

document.querySelectorAll(".btn-consulterPlaylist").forEach(function(btn) {
    btn.onclick = function() {
        document.querySelector("#id_modif_playlist").value = btn.getAttribute("data-idPlaylist");
        document.querySelector("#nom_modif_playlist").value = btn.getAttribute("data-nomPlaylist");
        document.querySelector("#id_user").value = btn.getAttribute("data-nomUtilisateur");
        modalConsulterPlaylist.style.display = "block";
    };
});

// Album

let modalAjouterAlbum = document.querySelector("#modal-ajouterAlbum");
let modalConsulterAlbum = document.querySelector("#modal-consulterAlbum");
let modalSupprimerAlbum = document.querySelector("#modal-supprimerAlbum");

document.querySelector("#btn-ajouterAlbum").onclick = function() {
    modalAjouterAlbum.style.display = "block";
}

document.querySelectorAll(".btn-supprimerAlbum").forEach(function(btn) {
    btn.onclick = function() {
        document.querySelector("#id_album_supprimer").value = btn.getAttribute("data-idAlbum");
        modalSupprimerAlbum.style.display = "block";
    };
});

document.querySelectorAll(".btn-consulterAlbum").forEach(function(btn) {
    btn.onclick = function() {
        document.querySelector("#id_modif_album").value = btn.getAttribute("data-idAlbum");
        document.querySelector("#titre_modif_album").value = btn.getAttribute("data-titreAlbum");
        document.querySelector("#description_modif_album").value = btn.getAttribute("data-descriptionAlbum");
        document.querySelector("#date_modif_album").value = btn.getAttribute("data-dateAlbum");
        document.querySelector("#id_artiste").value = btn.getAttribute("data-idArtiste");
        modalConsulterAlbum.style.display = "block";
    };
});

// Sons

let modalAjouterSon = document.querySelector("#modal-ajouterSon");
let modalConsulterSon = document.querySelector("#modal-consulterSon");
let modalSupprimerSon = document.querySelector("#modal-supprimerSon");

document.querySelector("#btn-ajouterSon").onclick = function() {
    modalAjouterSon.style.display = "block";
}

document.querySelectorAll(".btn-supprimerSon").forEach(function(btn) {
    btn.onclick = function() {
        document.querySelector("#id_son_supprimer").value = btn.getAttribute("data-idSon");
        modalSupprimerSon.style.display = "block";
    };
});

document.querySelectorAll(".btn-consulterSon").forEach(function(btn) {
    btn.onclick = function() {
        console.log(btn.getAttribute("data-mp3Son"));
        console.log(btn.getAttribute("data-albumSon"));
        document.querySelector("#id_modif_son").value = btn.getAttribute("data-idSon");
        document.querySelector("#titre_modif_son").value = btn.getAttribute("data-titreSon");
        document.querySelector("#duree_modif_son").value = btn.getAttribute("data-dureeSon");
        document.querySelector("#mp3_modif_son").value = btn.getAttribute("data-mp3Son");
        document.querySelector("#album_modif_son").value = btn.getAttribute("data-albumSon");
        modalConsulterSon.style.display = "block";
    };
});

let modalGererSonsPlaylist = document.querySelector("#modal-gererSonsPlaylist");

document.querySelectorAll(".btn-gererSonsPlaylist").forEach(function(btn) {
    btn.onclick = function() {
        document.querySelector("#id_playlist_sons").value = btn.getAttribute("data-idPlaylist");
        modalGererSonsPlaylist.style.display = "block";
    };
});
