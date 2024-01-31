// Sélection des éléments
const activeSquare = document.querySelector("#activeSquare");
const goToAccueilBtn = document.querySelector("#goToAccueil")
const goToRechercheBtn = document.querySelector("#goToRecherche")
const goToPlaylists = document.querySelector("#goToPlaylists")

const songcards = document.querySelectorAll(".song-card");

// Fonction pour changer de formulaire
function changeCurrentMenu(e,index) {
    e?.preventDefault();
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
            break;
        case 1:
            gsap.to(goToAccueilBtn, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            gsap.to(goToRechercheBtn, { color: "#0E100F", duration: 0.6,ease: "power4.out" });
            gsap.to(goToPlaylists, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            break;
        case 2:
            gsap.to(goToAccueilBtn, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            gsap.to(goToRechercheBtn, { color: "#FEFCE1", duration: 0.6,ease: "power4.out" });
            gsap.to(goToPlaylists, { color: "#0E100F", duration: 0.6,ease: "power4.out" });
            break;
    }
}

changeCurrentMenu(null,0);

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

// Gestionnaires d’événements
goToAccueilBtn.addEventListener('click', (e) => changeCurrentMenu(e,0));
goToRechercheBtn.addEventListener('click', (e) => changeCurrentMenu(e,1));
goToPlaylists.addEventListener('click', (e) => changeCurrentMenu(e,2));

songcards.forEach(songcard => {
    songcard.addEventListener('mouseenter', (e)=> handleSongCardHover(e, false))
    songcard.addEventListener('mouseleave', (e) => handleSongCardHover(e,true))
})