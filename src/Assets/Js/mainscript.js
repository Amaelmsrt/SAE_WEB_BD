// Sélection des éléments
const activeSquare = document.querySelector("#activeSquare");
const goToAccueilBtn = document.querySelector("#goToAccueil")
const goToRechercheBtn = document.querySelector("#goToRecherche")
const goToPlaylists = document.querySelector("#goToPlaylists")

const sectionAccueil = document.querySelector("#SectionAccueil")
const sectionRechercher = document.querySelector("#SectionRecherche")
const sectionPlaylists = document.querySelector("#SectionPlaylists") 


const activeSquareArtiste = document.querySelector("#activeSquareArtiste");
const goToTopTitres = document.querySelector("#goToTopTitres");
const goToAlbums = document.querySelector("#goToAlbums");

const sectionTopTitres = document.querySelector("#TopTitres");
const sectionAlbums = document.querySelector("#Albums");



const songcards = document.querySelectorAll(".song-card");

const menuDots = document.querySelectorAll(".menu-dots")

const bestResult = document.querySelector("#bestResult")
const goBackToRecherche = document.querySelector("#goBackToRecherche")

const pageArtiste = document.querySelector("#PageArtiste")
const pageRecherche = document.querySelector("#recherche")

const btnFavoris = document.querySelector("#MesFavoris")
const btnPlaylist = document.querySelector("#btnPlaylist")
const sectionFavoris= document.querySelector("#favoris")
const sectionPlaylist = document.querySelector("#playlist")

const btnNouvellePlaylist = document.querySelector("#NouvellePlaylist")
const btnClosePopUp = document.querySelector("#btnClosePopUp")
const popUpContainer = document.querySelector("#popUpContainer")
const popUpPlaylist = document.querySelector("#popUpPlaylist")

// Fonction pour changer de formulaire
function changeCurrentMenu(e,index) {
    e?.preventDefault();

    function clearActiveSections(){
        if (sectionAccueil.classList != null)
            sectionAccueil.classList.remove("active-section")
        if (sectionRechercher.classList != null)
        sectionRechercher.classList.remove("active-section")
        if (sectionPlaylists.classList != null)
            sectionPlaylists.classList.remove("active-section")
    }

    const curSection = document.querySelector(".active-section")
    let curIndex = -1
    if (e){
        const curSectionName = curSection.id.split("Section")[1]
        
        curIndex = curSectionName == "Accueil" ? 1 : curSectionName == "Recherche" ? 2 : curSectionName == "Playlists" ? 3 : -1
        if (e.target.id.split("goTo")[1] == curSectionName){
            return;
        }
    }
    // Si le formulaire d’inscription est visible, le cacher et montrer le formulaire de connexion
    // padding 1rem gap 0.65rem width des elements 11.25
    // 1 : 1rem
    // 2 : 1rem + 11.25rem + 0.65rem = 13.1rem
    // 3 : 1rem + 11.25rem + 0.65rem + 11.25rem + 0.65rem -1rem = 25.2rem
    gsap.to(activeSquare, { left: index === 0 ? "1rem" : index === 1 ? "13.1rem" : "25.2rem", duration: 0.6,ease: "power4.out" });
    
    // on change la couleur de #FEFCE1 à #0E100F
    // #FEFCE1 pour ceux qui n'ont pas le square derrière et #0E100F pour les autres

    switch(index){
        case 0:
            gsap.to(goToAccueilBtn, { color: "#0E100F", duration: 0.6,ease: "power4.out" });
            gsap.to(goToRechercheBtn, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            gsap.to(goToPlaylists, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            
            gsap.fromTo(sectionAccueil, {opacity: 0, x: index < curIndex ? "-100vw" : "100vw", zIndex: 1}, {opacity:1, x:0, duration:0.6, zIndex: 1, ease:"power4.out"})
            gsap.to(curSection, {opacity:0, x: index < curIndex ? "100vw" : "-100vw", duration:0.6, zIndex: -1, ease: "power4.out"})
            clearActiveSections()
            sectionAccueil.classList.add("active-section")
            break;
        case 1:
            gsap.to(goToAccueilBtn, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            gsap.to(goToRechercheBtn, { color: "#0E100F", duration: 0.6,ease: "power4.out" });
            gsap.to(goToPlaylists, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });

            gsap.fromTo(sectionRechercher, {opacity: 0, x: index < curIndex ? "-100vw" : "100vw", zIndex: 1}, {opacity:1, x:0, zIndex: 1, duration:0.6, ease:"power4.out"})
            gsap.to(curSection, {opacity:0, x: index < curIndex ? "100vw" : "-100vw", zIndex: -1, duration:0.6, ease: "power4.out"})

            clearActiveSections()
            sectionRechercher.classList.add("active-section")
            break;
        case 2:
            gsap.to(goToAccueilBtn, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            gsap.to(goToRechercheBtn, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            gsap.to(goToPlaylists, { color: "#0E100F", duration: 0.6,ease: "power4.out" });
            
            gsap.fromTo(sectionPlaylists, {opacity: 0, x: index < curIndex ? "-100vw" : "100vw", zIndex: 1}, {opacity:1, x:0, zIndex: 1, duration:0.6, ease:"power4.out"})
            gsap.to(curSection, {opacity:0, x:index<curIndex ? "100vw" : "-100vw", zIndex: -1, duration:0.6, ease: "power4.out"})

            clearActiveSections()
            sectionPlaylists.classList.add("active-section")
            break;
    }
}

changeCurrentMenu(null,0);

function clearActiveSectionsArtists(){
    if (sectionTopTitres.classList != null)
        sectionTopTitres.classList.remove("active-section-artiste")
    if (sectionAlbums.classList != null)
        sectionAlbums.classList.remove("active-section-artiste")
}

function changeCurrentMenuArtiste(e,index) {
    e?.preventDefault();

    const curSection = document.querySelector(".active-section-artiste")

    let curIndex = -1
    if (e){
        const curSectionName = curSection.id[1]
        
        curIndex = curSectionName == "TopTitres" ? 1 : curSectionName == "Albums" ? 2 : -1
        if (e.target.id.split("goTo")[1] == curSectionName){
            return;
        }
    }

    gsap.to(activeSquareArtiste, { left: index === 0 ? "1rem" : index === 1 ? "13.1rem" : "25.2rem", duration: 0.6,ease: "power4.out" });

    switch(index){
        case 0:
            gsap.to(goToTopTitres, { color: "#0E100F", duration: 0.8,ease: "power4.out" });
            gsap.to(goToAlbums, { color: "#FEFCE1", duration: 0.8,ease: "power4.out" });
            
            gsap.fromTo(sectionTopTitres, {opacity: 0, x: index < curIndex ? "-50vw" : "50vw", zIndex: 1}, {opacity:1, x:0, duration:0.6, zIndex: 1, ease:"power4.out"})
            gsap.to(curSection, {opacity:0, x: index < curIndex ? "50vw" : "-50vw", duration:0.6, zIndex: -1, ease: "power4.out"})
            clearActiveSectionsArtists()
            sectionTopTitres.classList.add("active-section-artiste")
            break;
        case 1:
            gsap.to(goToTopTitres, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            gsap.to(goToAlbums, { color: "#0E100F", duration: 0.6,ease: "power4.out" });

            gsap.fromTo(sectionAlbums, {opacity: 0, x: index < curIndex ? "-50vw" : "50vw", zIndex: 1}, {opacity:1, x:0, zIndex: 1, duration:0.6, ease:"power4.out"})
            gsap.to(curSection, {opacity:0, x: index < curIndex ? "50vw" : "-50vw", zIndex: -1, duration:0.6, ease: "power4.out"})

            clearActiveSectionsArtists()
            sectionAlbums.classList.add("active-section-artiste")
            break;
    }
}

const handleSongCardHover = (e, isLeaving) => {
    // j'ai envie de get les enfants de la songcard qui a été hover
    const songcard = e.currentTarget;
    const background = songcard.querySelector(".background");
    const cover = songcard.querySelector(".cover");
    const playBtn = songcard.querySelector(".play");

    // fais une transition sur l'opacité avec gsap sur le background
    gsap.to(background, { opacity: isLeaving ? 0 : 1, duration: 0.6,ease: "power4.out" });

    // le play btn passe de Y : 5 rem à y 0 quand il est hover
    gsap.to(playBtn, { y: isLeaving ? "5rem" : 0, opacity: isLeaving? 0 : 1,  duration: 0.6,ease: "power4.out" });

    // la cover de l'opacité de 1 à 0.7

    gsap.to(cover, { opacity: isLeaving ? 1 : 0.5, duration: 0.6,ease: "power4.out" });

}

function handleMenuDotsClick(e) {
    e.stopPropagation();
    const parent = e.currentTarget.parentElement.parentElement.parentElement;
    const menu = parent.querySelector(".menu");

    if (menu.style.display == "none" || menu.style.display == "") {
        gsap.fromTo(menu, {opacity: 0, y: "-10vh"}, {opacity:1, y:0, duration:0.6, ease:"power4.out"})
        menu.style.display = "block";
    }
    else {
        gsap.to(menu, {opacity:0, y:"-10vh", duration:0.6, ease:"power4.out"})
        setTimeout(() => {
            menu.style.display = "none";
        }, 600);
    }
}

function handleUnfocusEverything(e) {
    if (e.target.id == "popUpContainer"){
        closePlaylistPopUp()
        return;
    }
    if (e.target.classList.contains("menu-dots") || e.target.classList.contains("menu") || e.target.classList.contains("menu-item")) {
        return;
    }
    menuDots.forEach(menuDot => {
        const menu = menuDot.parentElement.parentElement.parentElement.querySelector(".menu");
        if (menu?.style.display == "block") {
            gsap.to(menu, {opacity:0, y:"-10vh", duration:0.6, ease:"power4.out"})
            setTimeout(() => {
                menu.style.display = "none";
            }, 600);
        }
    })
}

// Gestionnaires d’événements
goToAccueilBtn.addEventListener('click', (e) => changeCurrentMenu(e,0));
goToRechercheBtn.addEventListener('click', (e) => changeCurrentMenu(e,1));
goToPlaylists.addEventListener('click', (e) => changeCurrentMenu(e,2));

songcards.forEach(songcard => {
    songcard.addEventListener('mouseenter', (e)=> handleSongCardHover(e, false))
    songcard.addEventListener('mouseleave', (e) => handleSongCardHover(e,true))
})

menuDots.forEach(menuDot => {
    menuDot.addEventListener('click', handleMenuDotsClick)
})

document.addEventListener('click', handleUnfocusEverything)

function showArtiste(){
    // on fait juste une transition sur l'opacité et on scale out /in

    pageArtiste.style.display = "flex";

    changeCurrentMenuArtiste(null,0)

    gsap.fromTo(pageArtiste, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.6, delay:0.4,ease:"power4.out"})
    gsap.to(pageRecherche, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})

    setTimeout(() => {
        pageRecherche.style.display = "none";
    }, 500);
}

function showRecherche(){
    pageRecherche.style.display = "flex";

    // on fait juste une transition sur l'opacité et on scale out /in

    gsap.fromTo(pageRecherche, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.6, delay:0.4, ease:"power4.out"})
    gsap.to(pageArtiste, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})

    
    setTimeout(() => {
        changeCurrentMenuArtiste(null,0)
        clearActiveSectionsArtists()
        pageArtiste.style.display = "none";
    }, 500);
}

bestResult.addEventListener('click', showArtiste)
goBackToRecherche.addEventListener('click', showRecherche)
goToTopTitres.addEventListener('click', (e) => changeCurrentMenuArtiste(e,0))
goToAlbums.addEventListener('click', (e) => changeCurrentMenuArtiste(e,1))

function afficheMaPlaylist(){
    sectionPlaylist.style.display = "flex";

    gsap.fromTo(sectionPlaylist, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.6, delay:0.4, ease:"power4.out"})
    gsap.to(sectionFavoris, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})

    setTimeout(() => {
        sectionFavoris.style.display = "none";
    }, 500);
}

function afficheMesFavoris(){
    sectionFavoris.style.display = "flex";

    gsap.fromTo(sectionFavoris, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.6, delay:0.4, ease:"power4.out"})
    gsap.to(sectionPlaylist, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})

    setTimeout(() => {
        sectionPlaylist.style.display = "none";
    }, 500);
}

const openPlaylistPopUp = () => {
    popUpContainer.style.display = "flex";

    gsap.fromTo(popUpContainer, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.5, ease:"power4.out"})
}

const closePlaylistPopUp = () => {
    gsap.to(popUpContainer, {opacity:0, scale:0.9, duration:0.5, ease:"power4.out"})

    setTimeout(() => {
        popUpContainer.style.display = "none";
    }, 500);
}

btnPlaylist.addEventListener('click', afficheMaPlaylist)
btnFavoris.addEventListener('click', afficheMesFavoris)

btnNouvellePlaylist.addEventListener('click', openPlaylistPopUp)
btnClosePopUp.addEventListener('click', closePlaylistPopUp)