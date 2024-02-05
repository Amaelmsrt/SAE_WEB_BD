const activeSquare = document.querySelector("#activeSquare");
const goToMenuPrincipal = document.querySelector("#goToMenuPrincipal");
const goToArtistes = document.querySelector("#goToArtistes");
const goToSons = document.querySelector("#goToSons");
const goToGenres = document.querySelector("#goToGenres");
const goToUtilisateurs = document.querySelector("#goToUtilisateurs");
const goToPlaylists = document.querySelector("#goToPlaylists");
const goToAlbums = document.querySelector("#goToAlbums");

function changeCurrentMenu(e, index) {
    e?.preventDefault();

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
            break;

        case 1:
            gsap.to(goToMenuPrincipal, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToArtistes, {color: "#0E100F", duration: 0.6, ease:"power4.out"});
            gsap.to(goToSons, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToGenres, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToUtilisateurs, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToPlaylists, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToAlbums, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});           
            break;

        case 2:
            gsap.to(goToMenuPrincipal, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToArtistes, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToSons, {color: "#0E100F", duration: 0.6, ease:"power4.out"});
            gsap.to(goToGenres, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToUtilisateurs, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToPlaylists, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToAlbums, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            break;

        case 3:
            gsap.to(goToMenuPrincipal, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToArtistes, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToSons, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToGenres, {color: "#0E100F", duration: 0.6, ease:"power4.out"});
            gsap.to(goToUtilisateurs, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToPlaylists, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToAlbums, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            break;

        case 4:
            gsap.to(goToMenuPrincipal, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToArtistes, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToSons, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToGenres, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToUtilisateurs, {color: "#0E100F", duration: 0.6, ease:"power4.out"});
            gsap.to(goToPlaylists, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToAlbums, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});   
            break;
        case 5:
            gsap.to(goToMenuPrincipal, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToArtistes, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToSons, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToGenres, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToUtilisateurs, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToPlaylists, {color: "#0E100F", duration: 0.6, ease:"power4.out"});
            gsap.to(goToAlbums, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            break;
        case 6:
            gsap.to(goToMenuPrincipal, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToArtistes, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToSons, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToGenres, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToUtilisateurs, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToPlaylists, {color: "#FEFCE1", duration: 0.6, ease:"power4.out"});
            gsap.to(goToAlbums, {color: "#0E100F", duration: 0.6, ease:"power4.out"});
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

