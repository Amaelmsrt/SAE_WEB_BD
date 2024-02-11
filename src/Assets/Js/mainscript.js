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
const addToPlaylist = document.querySelectorAll(".addToPlaylist")

const bestResult = document.querySelector("#bestResult")
const goBackToRecherche = document.querySelector("#goBackToRecherche")

const pageArtiste = document.querySelector("#PageArtiste")
const pageRecherche = document.querySelector("#recherche")

const btnFavoris = document.querySelector("#MesFavoris")
const btnPlaylist = document.querySelector("#btnPlaylist")
const currentDisplay = document.querySelector(".current-display")
const sectionFavoris= document.querySelector("#favoris")
const sousSectionPlaylist = document.querySelector("#playlist")
let backSm = document.querySelector("#back-sm")

const btnNouvellePlaylist = document.querySelector("#NouvellePlaylist")
const btnClosePopUp = document.querySelectorAll("#btnClosePopUp")
const popUpContainer = document.querySelector("#popUpContainer")
const popUpPlaylist = document.querySelector("#popUpPlaylist")
const popUpFileAttente = document.querySelector("#popUpFileAttente")
const btnsOuvrirFileAttente = document.querySelectorAll(".btnOuvrirFileAttente")

const btnsToggleVolumeBar = document.querySelectorAll(".btn-toggle-volume-bar")
const volumeBars = document.querySelectorAll(".volume-bar")

const contentPlayer = document.querySelector("#contentPlayer")
const contentPlayerExitBtn = document.querySelector("#contentPlayerExitBtn")

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
        if (e.target.id.split("goTo")[1] == undefined){
            if (e.target.parentElement.id.split("goTo")[1] == curSectionName){
                return;
            }
            else {
                if (e.target.parentElement.parentElement.id.split("goTo")[1] == curSectionName){
                    return;
                }
            }
        }
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
            gsap.to(goToAccueilBtn, { color: window.innerWidth < 576 ? "#E2FF08" : "#0E100F", duration: 0.6,ease: "power4.out" });
            gsap.to(goToRechercheBtn, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            gsap.to(goToPlaylists, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            
            gsap.fromTo(sectionAccueil, {opacity: 0, x: index < curIndex ? "-100vw" : "100vw", zIndex: 1}, {opacity:1, x:0, duration:0.6, zIndex: 1, ease:"power4.out"})
            gsap.to(curSection, {opacity:0, x: index < curIndex ? "100vw" : "-100vw", duration:0.6, zIndex: -1, ease: "power4.out"})

            gsap.to(backSm, {display:"none", opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})

            clearActiveSections()
            sectionAccueil.classList.add("active-section")
            break;
        case 1:
            gsap.to(goToAccueilBtn, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            gsap.to(goToRechercheBtn, { color: window.innerWidth < 576 ? "#E2FF08" : "#0E100F", duration: 0.6,ease: "power4.out" });
            gsap.to(goToPlaylists, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });

            gsap.fromTo(sectionRechercher, {opacity: 0, x: index < curIndex ? "-100vw" : "100vw", zIndex: 1}, {opacity:1, x:0, zIndex: 1, duration:0.6, ease:"power4.out"})
            gsap.to(curSection, {opacity:0, x: index < curIndex ? "100vw" : "-100vw", zIndex: -1, duration:0.6, ease: "power4.out"})

            if (window.innerWidth < 576){
                // si la section recherche est active on doit afficher le backSm
                if (pageRecherche.style.opacity == 0 && pageRecherche.style.display == "none"){
                    const backSmParent = backSm.parentElement
                    const backSmClone = backSm.cloneNode(true)
                    backSmParent.replaceChild(backSmClone, backSm)
                    backSm = backSmClone
                    gsap.to(backSm, {display:"block", opacity:1, scale:1, duration:0.6, ease:"power4.out"})
                    backSm.addEventListener('click', () => {
                        showRecherche();
                        gsap.to(backSm, {display:"none", opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})
                    })
                }
                else{
                    gsap.to(backSm, {display:"none", opacity:0, scale:1, duration:0.6, ease:"power4.out"})
                }
            }

            clearActiveSections()
            sectionRechercher.classList.add("active-section")
            break;
        case 2:
            gsap.to(goToAccueilBtn, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            gsap.to(goToRechercheBtn, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            gsap.to(goToPlaylists, { color: window.innerWidth < 576 ? "#E2FF08" : "#0E100F", duration: 0.6,ease: "power4.out" });
            
            gsap.fromTo(sectionPlaylists, {opacity: 0, x: index < curIndex ? "-100vw" : "100vw", zIndex: 1}, {opacity:1, x:0, zIndex: 1, duration:0.6, ease:"power4.out"})
            gsap.to(curSection, {opacity:0, x:index<curIndex ? "100vw" : "-100vw", zIndex: -1, duration:0.6, ease: "power4.out"})

            if (window.innerWidth < 576){
                // si la section recherche est active on doit afficher le backSm
                const leftPlaylist = sectionPlaylists.querySelector(".left-content")
                if (leftPlaylist.style.display == "none" && leftPlaylist.style.opacity == 0){
                    const backSmParent = backSm.parentElement
                    const backSmClone = backSm.cloneNode(true)
                    backSmParent.replaceChild(backSmClone, backSm)
                    backSm = backSmClone
                    gsap.to(backSm, {display:"block", opacity:1, scale:1, duration:0.6, ease:"power4.out"})
                    backSm.addEventListener('click', () => {
                        afficheAccueilPlaylist();
                        gsap.to(backSm, {display:"none", opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})
                    })
                }
                else{
                    gsap.to(backSm, {display:"none", opacity:0, scale:1, duration:0.6, ease:"power4.out"})
                }
            }

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
    if (!e.target.classList.contains("isVolume")){
        volumeBars.forEach(volumeBar => {
            if (volumeBar.style.display == "flex"){
                toggleVolumeBar()
            }
        })

    }
    if (e.target.classList.contains("menu-dots") || e.target.classList.contains("menu")) {
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

    if (window.innerWidth < 576){
        gsap.to(backSm, {display:"block", opacity:1, scale:1, duration:0.6, ease:"power4.out"})
    
        backSm.addEventListener('click', () => {
            showRecherche();
            gsap.to(backSm, {display:"none", opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})
        })
    }


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

function afficheAccueilPlaylist(){
    if (window.innerWidth < 576){
        const leftPlaylist = sectionPlaylists.querySelector(".left-content")
        leftPlaylist.style.display = "flex";
    
        gsap.fromTo(leftPlaylist, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.6, delay:0.4, ease:"power4.out"})
        gsap.to(currentDisplay, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})
    
        setTimeout(() => {
            currentDisplay.style.display = "none";
        }, 500);
    }
}

function afficheMaPlaylist(){
    if (window.innerWidth < 576){
        gsap.to(backSm, {display:"block", opacity:1, scale:1, duration:0.6, ease:"power4.out"})
        backSm.addEventListener('click', () => {
            afficheAccueilPlaylist();
            gsap.to(backSm, {display:"none", opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})
        })
        const leftPlaylist = sectionPlaylists.querySelector(".left-content")
        gsap.to(leftPlaylist, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})
        gsap.to(currentDisplay, {display:"flex", opacity:1, scale:1, duration:0.6, delay:0.4, ease:"power4.out"});
        setTimeout(() => {
            leftPlaylist.style.display = "none";
        }, 600);
    }
    sousSectionPlaylist.style.display = "flex";

    gsap.fromTo(sousSectionPlaylist, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.6, delay:0.4, ease:"power4.out"})
    gsap.to(sectionFavoris, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})

    setTimeout(() => {
        sectionFavoris.style.display = "none";
    }, 500);
}

function afficheMesFavoris(){
    sectionFavoris.style.display = "flex";

    if (window.innerWidth < 576){
        gsap.to(backSm, {display:"block", opacity:1, scale:1, duration:0.6, ease:"power4.out"})
        backSm.addEventListener('click', () => {
            afficheAccueilPlaylist();
            gsap.to(backSm, {display:"none", opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})
        })
        const leftPlaylist = sectionPlaylists.querySelector(".left-content")
        gsap.to(leftPlaylist, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})
        gsap.to(currentDisplay, {display:"flex", opacity:1, scale:1, duration:0.6, delay:0.4, ease:"power4.out"});
        setTimeout(() => {
            leftPlaylist.style.display = "none";
        }, 600);
    }

    gsap.fromTo(sectionFavoris, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.6, delay:0.4, ease:"power4.out"})
    gsap.to(sousSectionPlaylist, {opacity:0, scale:0.9, duration:0.6, ease:"power4.out"})

    setTimeout(() => {
        sousSectionPlaylist.style.display = "none";
    }, 500);
}

const openFileAttentePopUp = () => {
    popUpContainer.style.display = "flex";

    popUpFileAttente.style.display = "flex";
    popUpPlaylist.style.display = "none";

    gsap.fromTo(popUpContainer, {opacity: 0, scale: 0.9}, {opacity:1, scale:1, duration:0.5, ease:"power4.out"})
}

const openPlaylistPopUp = () => {
    popUpContainer.style.display = "flex";

    popUpPlaylist.style.display = "flex";
    popUpFileAttente.style.display = "none";

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
btnClosePopUp.forEach(btn => btn.addEventListener('click', closePlaylistPopUp))
btnsOuvrirFileAttente.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();   
        openFileAttentePopUp()
    })
})

let isToggling = false;

function toggleVolumeBar(){
    if (isToggling){
        return;
    }
    isToggling = true;
    volumeBars.forEach(volumeBar => {
        if (volumeBar.style.display == "none" || volumeBar.style.display == ""){
            gsap.fromTo(volumeBar, {opacity: 0, y: "-3vh"}, {opacity:1, y:0, duration:0.6, ease:"power4.out"})
            volumeBar.style.display = "flex";
            setTimeout(() => {
                isToggling = false;
            }, 600);
        }
        else {
            gsap.to(volumeBar, {opacity:0, y:"-3vh", duration:0.6, ease:"power4.out"})
            setTimeout(() => {
                volumeBar.style.display = "none";
                isToggling = false;
            }, 600);
        }
    }) 
}

function updateAllVolumeBars(){
    volumeBars.forEach(volumeBar => {
        const volume = volumeBar.querySelector(".bar")
        // c'est un input type range
        volume.value = this.value
    })
}

volumeBars.forEach(volumeBar => {
    const volume = volumeBar.querySelector(".bar")
    volume.addEventListener('input', updateAllVolumeBars)
})

btnsToggleVolumeBar.forEach(btn => {
    btn.addEventListener('click', toggleVolumeBar);
})

function handleContentPlayerClick(e){
    e.stopPropagation();
    const windowWidth = window.innerWidth;
    if (windowWidth < 576){

        // en dessous de 756px c'est 8
        const remToPx = 8
        const vwToPx = window.innerWidth / 100
        const defaultBorderRadiusCover = 10;

        // on doit calculer la taille de la cover pour qu'elle passe de 8rem à 70vw
        // sachant qu'on connait remToPx et vwToPx
        const scaleValueForCover = (70*vwToPx) / (8*remToPx)
        // duplique le content player et le met en position absolute

        const newSizes = "70vw"
        const newContentPlayer = contentPlayer.cloneNode(true);
        newContentPlayer.style.position = "absolute";
        newContentPlayer.style.zIndex = -1;
        // je veux lui appliquer tous les styles que j'applique après avec gsap
        newContentPlayer.style.bottom = "0vh";
        newContentPlayer.style.left = "0";
        newContentPlayer.style.height = "100vh";
        newContentPlayer.style.maxHeight = "100vh";
        newContentPlayer.style.width = "100%";
        newContentPlayer.style.maxWidth = "100%";
        newContentPlayer.style.transform = "translateY(0vh)";
        newContentPlayer.style.zIndex = 1000;
        newContentPlayer.style.opacity = 0;
        
        const duplicatedBackground = newContentPlayer.querySelector(".background")
        const duplicatedTopContent = newContentPlayer.querySelector(".top-content")
        const duplicatedCoverContainer = newContentPlayer.querySelector(".cover-container")
        const duplicatedPlayPause = newContentPlayer.querySelector(".play-pause")
        const duplicatedInnerContent = newContentPlayer.querySelector(".inner-content")
        const duplicatedTopSm = newContentPlayer.querySelector(".top-sm")
        const duplicatedLikeSong = newContentPlayer.querySelector(".likeSong")
        const duplicatedMediaInfos = newContentPlayer.querySelector(".media-infos")
        const duplicatedActions = newContentPlayer.querySelector(".actions")
        const duplicatedFileAttente = newContentPlayer.querySelector(".file-attente")
        const duplicatedProgresssm = newContentPlayer.querySelector(".progress.sm")

        const duplicatedCurSong = newContentPlayer.querySelector("#nom-song")
        const duplicatedCurArtiste = newContentPlayer.querySelector("#nom-artist")
        const duplicatedMainHeart = newContentPlayer.querySelector("#main-heart")

        newContentPlayer.classList.add("duplicatedContentPlayer")
        newContentPlayer.classList.remove("realContentPlayer")
        const duplicatedContentPlayerCloseBtn = newContentPlayer.querySelector("#contentPlayerExitBtn")
        duplicatedContentPlayerCloseBtn.addEventListener('click', closeContentPlayer)

        duplicatedBackground.style.height = "20%";

        duplicatedTopContent.style.flexDirection = "column";
        
        duplicatedCoverContainer.style.width = newSizes;
        duplicatedCoverContainer.style.opacity = 1;
        duplicatedCoverContainer.style.height = newSizes;
        duplicatedCoverContainer.style.maxWidth = newSizes;
        duplicatedCoverContainer.style.maxHeight = newSizes;
        duplicatedCoverContainer.style.borderRadius = (defaultBorderRadiusCover * scaleValueForCover)+"px";

        duplicatedPlayPause.style.opacity = 0;
        
        duplicatedInnerContent.style.justifyContent = "unset";
        duplicatedInnerContent.style.padding = "4rem";

        duplicatedMediaInfos.style.width = newSizes;
        duplicatedMediaInfos.style.flexDirection = "column";

        duplicatedActions.style.display = "flex";
        duplicatedActions.style.opacity = 1;
        duplicatedActions.style.width = "100%";
        duplicatedActions.style.gap = "5rem";
        duplicatedActions.style.marginTop = "5rem";

        duplicatedTopSm.style.display = "flex";
        
        duplicatedFileAttente.style.display = "flex";

        duplicatedFileAttente.style.opacity = 1;

        duplicatedLikeSong.style.transform = "translateX(9rem)";

        duplicatedProgresssm.style.display = "none";

        contentPlayer.parentElement.appendChild(newContentPlayer);

        const mainNav = document.querySelector(".main-nav")
        const background = contentPlayer.querySelector(".background")
        const topContent = contentPlayer.querySelector(".top-content")
        const coverContainer = contentPlayer.querySelector(".cover-container")
        const playPause = contentPlayer.querySelector(".play-pause")
        const innerContent = contentPlayer.querySelector(".inner-content")
        const topSm = contentPlayer.querySelector(".top-sm")
        const likeSong = contentPlayer.querySelector(".likeSong")
        const mediaInfos = contentPlayer.querySelector(".media-infos")
        const actions = contentPlayer.querySelector(".actions")
        const fileAttente = contentPlayer.querySelector(".file-attente")
        const progresssm = contentPlayer.querySelector(".progress.sm")
        
        const curSong = contentPlayer.querySelector("#nom-song")
        const curArtiste = contentPlayer.querySelector("#nom-artist")
        const mainHeart = contentPlayer.querySelector("#main-heart")

        const xCurSong = curSong.getBoundingClientRect().x
        const yCurSong = curSong.getBoundingClientRect().y
        const heightCurSong = curSong.getBoundingClientRect().height
        const widthCurSong = curSong.getBoundingClientRect().width

        const xCurSongDefault = duplicatedCurSong.getBoundingClientRect().x
        const yCurSongDefault = duplicatedCurSong.getBoundingClientRect().y

        const newCurSongX = -widthCurSong + xCurSongDefault - 7
        

        gsap.to(curSong, {x:newCurSongX, y:yCurSongDefault, duration:0.4, ease:"custom"})
        gsap.to(curArtiste, {x:newCurSongX, y:yCurSongDefault, duration:0.4, ease:"custom"})

        const xMainHeart = mainHeart.getBoundingClientRect().x
        const widthMainHeart = mainHeart.getBoundingClientRect().width

        const xMainHeartDefault = duplicatedMainHeart.getBoundingClientRect().x
        const yMainHeartDefault = duplicatedMainHeart.getBoundingClientRect().y

        const newHeartX = -xMainHeart + xMainHeartDefault - (widthMainHeart/2) +3

        gsap.to(mainHeart, {x:newHeartX,y:yMainHeartDefault, duration:0.4, ease:"custom"})

        gsap.registerPlugin(CustomEase);

        contentPlayer.style.overflowX = "hidden";

        CustomEase.create("custom", "M0,0 C0.5,0 0.5,1 1,1");

        // je veux que le mainnav perde en opacité et descende en bas

        gsap.to(mainNav, {opacity:0, y:"10vh", duration:0.4, ease:"custom"})

        gsap.to(contentPlayer, {
            bottom:"0vh", 
            left:0,
            y: 0,
            height:"100vh",
            maxHeight:"100vh",
            width:"100%",
            maxWidth:"100%", 
            duration:0.4,
            ease:"custom"
        })

        gsap.to(background, {height:"20%", opacity:1, duration:0.4, ease:"custom"})

        const xDuplicatedCover = duplicatedCoverContainer.getBoundingClientRect().x
        const yDuplicatedCover = duplicatedCoverContainer.getBoundingClientRect().top

        const duplicatedCoverBorderSize = 70 * vwToPx

        const xCoverDefault = coverContainer.getBoundingClientRect().x
        // sachant que je vais faire un scale de scaleValueForCover, j'ai besoin de savoir quel sera le x de la cover
        //const resX = -xDuplicatedCover + (duplicatedCoverBorderSize/2) + xCoverDefault
        const resX = -xDuplicatedCover + (duplicatedCoverBorderSize/2) + xDuplicatedCover + xCoverDefault -1

        const midY = (window.innerHeight / 2) - (duplicatedCoverBorderSize/2) // ça correspond à la valeur de y qu'on aura après avoir fait le scale + l'aggrandissement à 100vh du menu
        console.log(midY)
        const resY = -midY + yDuplicatedCover // on fait -midY pour que la cover soit tout en haut de l'écran puis on n'a qu'à ajouter le y de la cover dupliquéeé (qui est invisible) pour qu'elle aille à sa position

        //console.log(coverContainer.getBoundingClientRect())

        gsap.to(coverContainer, {
            scale:scaleValueForCover,
            duration:0.4,
            x: resX,
            y: resY,
            // je veux le mettre en haut à gauche
            ease:"custom"
        })

        // setTimeout(() => {
        //     console.log("window height" + window.innerHeight)
        //     console.log("scalevalue" + scaleValueForCover)
        //     console.log(coverContainer.getBoundingClientRect())
        // }, 400);
        
        gsap.to(playPause, {opacity:0, duration:0.2, ease:"custom"})
        gsap.to(progresssm, {display:"none", opacity:0, duration:0.4, ease:"custom"})

        gsap.to(newContentPlayer, {opacity:1, zIndex:1000, duration:0.6, delay:0.2, ease:"custom"})

        setTimeout(() => {
            contentPlayer.style.opacity = 0;
            contentPlayer.style.display = "block";
            contentPlayer.style.zIndex = -1;

            // on remet le contentplayer avec tous ses styles par défaut

            // on va reset les transform sur les textes et les heart

            gsap.to(curSong, {x:0, y:0, duration:0, ease:"custom"})
            gsap.to(curArtiste, {x:0, y:0, duration:0, ease:"custom"})
            gsap.to(mainHeart, {x:0, y:0, duration:0, ease:"custom"})

            mainNav.style.opacity = 1;
            mainNav.style.y = 0;


            contentPlayer.style.bottom = "10vh";
            contentPlayer.style.left = "2%";
            contentPlayer.style.transform = "translateY(10%)";
            contentPlayer.style.height = "10vh";
            contentPlayer.style.maxHeight = "10vh";
            contentPlayer.style.width = "96%";
            contentPlayer.style.maxWidth = "96%";
            contentPlayer.style.overflowX = "hidden";

            background.style.height = "100%";
            background.style.opacity = 1;

            topContent.style.flexDirection = "row";

            const finalSizes = "8rem"
            // on va reset le scale et les translate de la cover
            gsap.to(coverContainer, {scale:1, x:0, y:0, duration:0, ease:"custom"})
            coverContainer.style.width = finalSizes;
            coverContainer.style.height = finalSizes;
            coverContainer.style.maxWidth = finalSizes;
            coverContainer.style.maxHeight = finalSizes;

            playPause.style.opacity = 1;

            innerContent.style.justifyContent = "center";
            innerContent.style.padding = "1rem 2rem";

            actions.style.display = "none";

            fileAttente.style.display = "none";

            mediaInfos.style.width = "100%";

            topSm.style.display = "none";

            likeSong.style.transform = "translateX(0)";

            progresssm.style.display = "flex";
            gsap.to(progresssm, {opacity:1, duration:0, ease:"custom"})
        }, 800);
    }


    // on met à jour les btnsOuvrirFileAttente
    document.querySelectorAll(".btnOuvrirFileAttente").forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            openFileAttentePopUp()
        })
    })
}

function closeContentPlayer(e){
    e.stopPropagation();
    const windowWidth = window.innerWidth;
    if (windowWidth < 576){

        contentPlayer.style.zIndex = 2000;

        // en dessous de 756px c'est 8
        const remToPx = 8
        const vwToPx = window.innerWidth / 100
        // on doit calculer la taille de la cover pour qu'elle passe de 8rem à 70vw
        // sachant qu'on connait remToPx et vwToPx
        const scaleValueForCover = (8*remToPx) / (70*vwToPx) 
        // duplique le content player et le met en position absolute

        const newSizes = "8rem"
        const newContentPlayer = contentPlayer;

        
        const newBackground = newContentPlayer.querySelector(".background")
        const newTopContent = newContentPlayer.querySelector(".top-content")
        const newCoverContainer = newContentPlayer.querySelector(".cover-container")
        const newPlayPause = newContentPlayer.querySelector(".play-pause")
        const newInnerContent = newContentPlayer.querySelector(".inner-content")
        const newTopSm = newContentPlayer.querySelector(".top-sm")
        const newLikeSong = newContentPlayer.querySelector(".likeSong")
        const newMediaInfos = newContentPlayer.querySelector(".media-infos")
        const newActions = newContentPlayer.querySelector(".actions")
        const newProgresssm = newContentPlayer.querySelector(".progress.sm")

        const newCurSong = newContentPlayer.querySelector("#nom-song")
        const newCurArtiste = newContentPlayer.querySelector("#nom-artist")
        const newMainHeart = newContentPlayer.querySelector("#main-heart")

        // le reste du code


        const mainNav = document.querySelector(".main-nav")
        const oldContentPlayer = document.querySelector(".duplicatedContentPlayer")
        
        const background = oldContentPlayer.querySelector(".background")
        const topContent = oldContentPlayer.querySelector(".top-content")
        const coverContainer = oldContentPlayer.querySelector(".cover-container")
        const playPause = oldContentPlayer.querySelector(".play-pause")
        const innerContent = oldContentPlayer.querySelector(".inner-content")
        const topSm = oldContentPlayer.querySelector(".top-sm")
        const likeSong = oldContentPlayer.querySelector(".likeSong")
        const mediaInfos = oldContentPlayer.querySelector(".media-infos")
        const actions = oldContentPlayer.querySelector(".actions")
        const fileAttente = oldContentPlayer.querySelector(".file-attente")
        const progresssm = oldContentPlayer.querySelector(".progress.sm")
        
        const curSong = oldContentPlayer.querySelector("#nom-song")
        const curArtiste = oldContentPlayer.querySelector("#nom-artist")
        const mainHeart = oldContentPlayer.querySelector("#main-heart")

        const xCurSong = curSong.getBoundingClientRect().x
        const yCurSong = curSong.getBoundingClientRect().y
        const heightCurSong = curSong.getBoundingClientRect().height
        const widthCurSong = curSong.getBoundingClientRect().width

        const xCurSongDefault = newCurSong.getBoundingClientRect().x
        const yCurSongDefault = newCurSong.getBoundingClientRect().y

        const newCurSongX = -widthCurSong + xCurSongDefault - 7
        
        const addedY = 8 // ce qu'on ajoute en gap
        
        gsap.to(curSong, {x:newCurSongX, y:addedY, duration:0.4, ease:"custom"})
        gsap.to(curArtiste, {x:newCurSongX, y:addedY, duration:0.4, ease:"custom"})

        const xMainHeart = mainHeart.getBoundingClientRect().x
        const yMainHeart = mainHeart.getBoundingClientRect().y
        const widthMainHeart = mainHeart.getBoundingClientRect().width

        const xMainHeartDefault = newMainHeart.getBoundingClientRect().x
        const yMainHeartDefault = newMainHeart.getBoundingClientRect().y

        const newHeartX = -xMainHeart + xMainHeartDefault - (widthMainHeart/2) +3

        gsap.to(mainHeart, {x:newHeartX,y:addedY, duration:0.4, ease:"custom"})

        gsap.registerPlugin(CustomEase);

        oldContentPlayer.style.overflowX = "hidden";
        innerContent.style.overflowY = "hidden";

        CustomEase.create("custom", "M0,0 C0.5,0 0.5,1 1,1");

        // je veux que le mainnav perde en opacité et descende en bas

        gsap.to(mainNav, {opacity:1, y:"0vh", duration:0.4, ease:"custom"})

        gsap.to(oldContentPlayer, {
            bottom:"10vh", 
            left:"2%",
            y: "10%",
            height:"10vh",
            maxHeight:"10vh",
            width:"96%",
            maxWidth:"96%", 
            duration:0.4,
            ease:"custom",
            zIndex: 999
        })

        gsap.to(background, {height:"100%", opacity:1, duration:0.4, ease:"custom"})

        const xNewCover = 0
        const yNewCover = 0

        const newCoverBorderSize = 8 * remToPx

        const xCoverDuplicated = coverContainer.getBoundingClientRect().x
        // sachant que je vais faire un scale de scaleValueForCover, j'ai besoin de savoir quel sera le x de la cover
        //const resX = -xDuplicatedCover + (duplicatedCoverBorderSize/2) + xCoverDefault
        const resX = -xNewCover + (newCoverBorderSize/2) + xNewCover + xCoverDuplicated - 1
        const resY = yNewCover - (newCoverBorderSize) + yNewCover - 6

        gsap.to(coverContainer, {
            scale:scaleValueForCover,
            duration:0.5,
            x: -2*resX,
            y: resY,
            // je veux le mettre en haut à gauche
            ease:"custom"
        })
        
        gsap.to(playPause, {opacity:1, duration:0.2, ease:"custom"})
        gsap.to(progresssm, {display:"flex", opacity:1, duration:0.4, ease:"custom"})

  
        gsap.to(newContentPlayer, {opacity:1, zIndex:1000, duration:0.6, delay:0.2, ease:"custom"})
        
        setTimeout(() => {
            // on va suppr le oldContentPlayer
            
            oldContentPlayer.remove();
            
        }, 800);
    }
}


contentPlayer.addEventListener('click', handleContentPlayerClick)

contentPlayerExitBtn.addEventListener('click', closeContentPlayer)


function handleHoverAddToPlaylist(e, isLeaving){
    const parent = e.currentTarget.parentElement;
    const submenu = parent.querySelector(".sub");

    // anime le y très légérement et l'opacité de la sub

    gsap.to(submenu, {display: isLeaving ? "none" : "flex", y: isLeaving ? "1rem" : 0, opacity: isLeaving ? 0 : 1, duration: 0.6,ease: "power4.out" });

}

addToPlaylist.forEach(add => {
    const parent = add.parentElement;
    add.addEventListener('mouseenter', (e) => handleHoverAddToPlaylist(e, false))
    parent.addEventListener('mouseleave', (e) => handleHoverAddToPlaylist(e, true))
})

const detailsAccueil = document.querySelector(".details");
const defaultAccueil = document.querySelector(".default");

const voirmoins = document.querySelector("#voirmoins");
const voirtout = document.querySelector("#voirtout");

// il faut faire la même anim que j'ai fait pour la recherche/artiste
function afficherDefaultAccueil(e){
    e?.preventDefault();
    defaultAccueil.parentElement.style.overflowY = "auto";
    defaultAccueil.style.display = "flex";
    
    gsap.to(detailsAccueil, {display:"none", scale:0.9, opacity:0, duration:0.6, ease:"power4.out"})
    gsap.to(defaultAccueil, {display:"flex", scale:1, opacity:1, duration:0.6, delay:0.4, ease:"power4.out"})

    setTimeout(() => {
        detailsAccueil.style.display = "none";
    }, 600);
}

function afficherDetailsAccueil(e){
    e?.preventDefault();
    defaultAccueil.parentElement.style.overflowY = "hidden";
    detailsAccueil.style.display = "flex";

    gsap.to(defaultAccueil, {display:"none", scale:0.9, opacity:0, duration:0.6, ease:"power4.out"})
    gsap.to(detailsAccueil, {display:"flex", scale:1, opacity:1, duration:0.6, delay:0.4, ease:"power4.out"})

    setTimeout(() => {
        defaultAccueil.style.display = "none";
    }, 600);
}

afficherDefaultAccueil();

voirmoins.addEventListener('click', afficherDefaultAccueil)
voirtout.addEventListener('click', afficherDetailsAccueil)