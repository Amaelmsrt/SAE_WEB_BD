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


function changeCurrentMenu(e, index) {
    e?.preventDefault();

    function clearActiveSections() {
        if (sectionMenuPrincipal.classList != null)
            sectionMenuPrincipal.classList.remove("active-section");
        if (sectionMenuArtistes.classList != null)
            sectionMenuArtistes.classList.remove("active-section");
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

    const curSection = document.querySelector(".active-section");
    let curIndex = -1;
    if (e) {
        const curSectionName = curSection.id.split("page")[1];

        curIndex = curSectionName == "Principale" ? 0 : curSectionName == "Artistes" ? 1 : curSectionName == "Sons" ? 2 : curSectionName == "Genres" ? 3 : curSectionName == "Utilisateurs" ? 4 : curSectionName == "Playlists" ? 5 : 6;
        if (e.target.id.split("goTo")[1] == curSectionName) return;
    }

    const menuItemHeight = 3.5;

    const menuItemMargin = 0.85;

    const startPosition = 1;

    const position = startPosition + index * (menuItemHeight + menuItemMargin);

    gsap.to(activeSquare, { top: `${position}rem`, duration: 0.6, ease: "power4.out" });

    const menuItems = [goToMenuPrincipal, goToArtistes, goToSons, goToGenres, goToUtilisateurs, goToPlaylists, goToAlbums];
    menuItems.forEach((menuItem, i) => {
        gsap.to(menuItem, { color: i === index ? "#0E100F" : "#FEFCE1", duration: 0.6, ease: "power4.out" });
    });

    switch(index) {
        case 0:
            gsap.to(goToMenuPrincipal, {color: "#0E100F", duration: 0.6, ease:"power4.out"});
            gsap.to(goToArtistes, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToSons, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToGenres, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToUtilisateurs, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToPlaylists, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToAlbums, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});

            gsap.fromTo(sectionMenuPrincipal, {opacity: 0, y: index < curIndex ? "-100vw" : "100vw"}, {opacity: 1, y: 0, duration: 0.6, zIndex: 1, ease:"power4.out"});
            gsap.to(curSection, {opacity:0, y: index < curIndex ? "100vw" : "-100vw", duration:0.6, zIndex: -1, ease: "power4.out"});
            clearActiveSections();
            sectionMenuPrincipal.classList.add("active-section");
            break;

        case 1:
            gsap.to(goToMenuPrincipal, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToArtistes, {color: "#0E100F", duration: 0.6, ease:"power4.out"});
            gsap.to(goToSons, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToGenres, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToUtilisateurs, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToPlaylists, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToAlbums, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});

            gsap.fromTo(sectionMenuArtistes, {opacity: 0, y: index < curIndex ? "-100vw" : "100vw"}, {opacity: 1, y: 0, duration: 0.6, zIndex: 1, ease:"power4.out"});
            gsap.to(curSection, {opacity:0, y: index < curIndex ? "100vw" : "-100vw", duration:0.6, zIndex: -1, ease: "power4.out"});

            clearActiveSections();
            sectionMenuArtistes.classList.add("active-section");
            break;

        case 2:
            gsap.to(goToMenuPrincipal, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToArtistes, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToSons, {color: "#0E100F", duration: 0.6, ease:"power4.out"});
            gsap.to(goToGenres, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToUtilisateurs, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToPlaylists, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToAlbums, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});

            gsap.fromTo(sectionMenuSons, {opacity: 0, y: index < curIndex ? "-100vw" : "100vw"}, {opacity: 1, y: 0, duration: 0.6, zIndex: 1, ease:"power4.out"});
            gsap.to(curSection, {opacity:0, y: index < curIndex ? "100vw" : "-100vw", duration:0.6, zIndex: -1, ease: "power4.out"});

            clearActiveSections();
            sectionMenuSons.classList.add("active-section");
            break;

        case 3:
            gsap.to(goToMenuPrincipal, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToArtistes, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToSons, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToGenres, {color: "#0E100F", duration: 0.6, ease:"power4.out"});
            gsap.to(goToUtilisateurs, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToPlaylists, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToAlbums, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});

            gsap.fromTo(sectionMenuGenres, {opacity: 0, y: index < curIndex ? "-100vw" : "100vw"}, {opacity: 1, y: 0, duration: 0.6, zIndex: 1, ease:"power4.out"});
            gsap.to(curSection, {opacity:0, y: index < curIndex ? "100vw" : "-100vw", duration:0.6, zIndex: -1, ease: "power4.out"});

            clearActiveSections();
            sectionMenuGenres.classList.add("active-section");
            break;

        case 4:
            gsap.to(goToMenuPrincipal, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToArtistes, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToSons, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToGenres, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToUtilisateurs, {color: "#0E100F", duration: 0.6, ease:"power4.out"});
            gsap.to(goToPlaylists, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToAlbums, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});

            gsap.fromTo(sectionMenuUtilisateurs, {opacity: 0, y: index < curIndex ? "-100vw" : "100vw"}, {opacity: 1, y: 0, duration: 0.6, zIndex: 1, ease:"power4.out"});
            gsap.to(curSection, {opacity:0, y: index < curIndex ? "100vw" : "-100vw", duration:0.6, zIndex: -1, ease: "power4.out"});

            clearActiveSections();
            sectionMenuUtilisateurs.classList.add("active-section");
            break;
        case 5:
            gsap.to(goToMenuPrincipal, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToArtistes, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToSons, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToGenres, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToUtilisateurs, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToPlaylists, {color: "#0E100F", duration: 0.6, ease:"power4.out"});
            gsap.to(goToAlbums, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});

            gsap.fromTo(sectionMenuPlaylists, {opacity: 0, y: index < curIndex ? "-100vw" : "100vw"}, {opacity: 1, y: 0, duration: 0.6, zIndex: 1, ease:"power4.out"});
            gsap.to(curSection, {opacity:0, y: index < curIndex ? "100vw" : "-100vw", duration:0.6, zIndex: -1, ease: "power4.out"});

            clearActiveSections();
            sectionMenuPlaylists.classList.add("active-section");
            break;
        case 6:
            gsap.to(goToMenuPrincipal, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToArtistes, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToSons, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToGenres, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToUtilisateurs, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToPlaylists, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToAlbums, {color: "#0E100F", duration: 0.6, ease:"power4.out"});

            gsap.fromTo(sectionMenuAlbums, {opacity: 0, y: index < curIndex ? "-100vw" : "100vw"}, {opacity: 1, y: 0, duration: 0.6, zIndex: 1, ease:"power4.out"});
            gsap.to(curSection, {opacity:0, y: index < curIndex ? "c100vw" : "-100vw", duration:0.6, zIndex: -1, ease: "power4.out"});

            clearActiveSections();
            sectionMenuAlbums.classList.add("active-section");
            break;
    }
}

changeCurrentMenu(null, 0);

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
let modalModifierArtiste = document.querySelector("#modal-modifierArtiste");
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