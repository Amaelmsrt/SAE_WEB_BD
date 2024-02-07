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

