// Sélection des éléments
const inscriptionForm = document.getElementById('inscription');
const connexionForm = document.getElementById('connexion');
const goToInscriptionBtn = document.getElementById('goToConnexion');
const goToConnexionBtn = document.getElementById('goToInscription');

// Fonction pour changer de formulaire
function toggleForms(isConnection = true) {
    // Si le formulaire d’inscription est visible, le cacher et montrer le formulaire de connexion
    if (!isConnection) {
        gsap.fromTo(connexionForm, { x: '100%', opacity: 0 }, { x: '0%', opacity: 1, duration: 0.8, ease: "power4.out" });
        gsap.to(inscriptionForm, { x: '-100%', opacity: 0, duration: 0.8,ease: "power4.out" });
        setTimeout(() => {
            inscriptionForm.style.display = 'none';
        }, 500);
    } else { // Sinon faire l'inverse
        gsap.fromTo(inscriptionForm, { x: '-100%', opacity: 0 }, { x: '0%', opacity: 1, duration: 0.8, ease: "power4.out" });
        gsap.to(connexionForm, { x: '100%', opacity: 0, duration: 0.8,ease: "power4.out" });
        setTimeout(() => {
            connexionForm.style.display = 'none';
        }, 500);
    }
}

// Gestionnaires d’événements
goToInscriptionBtn.addEventListener('click', () => toggleForms(false));
goToConnexionBtn.addEventListener('click', () => toggleForms());