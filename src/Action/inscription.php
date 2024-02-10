<?php

use DB\DataBaseManager;

$messageErreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];

        if (strlen($mdp) < 8) {
            $messageErreur = "Le mot de passe doit contenir au moins 8 caractères.";
        }
        if (!preg_match('/\d/', $mdp)) {
            $messageErreur = "Le mot de passe doit contenir au moins un chiffre.";
        } 
        if (!preg_match('/[A-Z]/', $mdp)) {
            $messageErreur = "Le mot de passe doit contenir au moins une lettre majuscule.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $messageErreur = "L'adresse email n'est pas valide.";
        }

        if ($messageErreur === "") {
            $manager = new DataBaseManager();
            $utilisateurBD = $manager->getUtilisateurDB();
            $utilisateur = $utilisateurBD->findWithPseudo($pseudo);
            if ($utilisateur === null) {
                $utilisateurBD->insertUser($nom, $prenom, $pseudo, $email, $mdp);
                header('Location: index.php?action=connexion');
            } else {
                $messageErreur = "Ce pseudo est déjà utilisé.";
            }
        }
    }
}

?>

<main>
    <img class="logo" src="./Assets/images/logo.svg" alt="logo"/>
    
    <div class="connection">
        <form class="container-connexion" id="inscription" action="index.php?action=inscription" method="post">

            <div class="top-content">
                <legend>INSCRIPTION</legend>
                
                <section class="inputs">
                    <div class="container-textfields">
                        <div class="text-field no-space">
                            <input type="text" placeholder="Nom" name="nom" value="<?php echo isset($nom) ? $nom : ''; ?>" required>
                        </div>
                        <div class="text-field no-space">
                            
                            <input type="text" placeholder="Prénom" name="prenom" value="<?php echo isset($prenom) ? $prenom : ''; ?>" required>
                        </div>
                    </div>
                    <div class="container-textfields">
                        <div class="text-field">
                            <img src="./assets/icons/user.svg" alt="user"/>
                            <input type="text" placeholder="Nom d'utilisateur" name="pseudo" value="<?php echo isset($pseudo) ? $pseudo : ''; ?>" required>
                        </div>
                        <div class="text-field">
                            <img src="./assets/icons/mail.svg" alt="mail">
                            <input type="email" placeholder="Adresse e-mail" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                        </div>
                    </div>
                    <div class="text-field">
                        <img src="./assets/icons/lock.svg" alt="lock">
                        <input type="password" placeholder="Mot de passe" name="mdp" value="<?php echo isset($mdp) ? $mdp : ''; ?>" required>
                    </div>
                </section>
            </div>
            <?php if (!empty($messageErreur)): ?>
                <p class="erreur" style="color: red"><?php echo $messageErreur; ?></p>
            <?php endif; ?>
            <div class="bottom-content">
                <button type="button" id="goToConnexion">
                    <img src="./assets/icons/back-arrow.svg" alt="back-arrow">
                </button>
    
                <div class="buttons">
                    <button type="submit">
                        <img src="./assets/icons/right-arrow.svg" alt="arrow">    
                        M'inscrire
                    </button>
                </div>
            </div>
        </form>

        <form id="connexion" class="container-connexion" action="index.php?action=connexion" method="post">
    
            <div class="top-content">
                <legend>ME CONNECTER</legend>
                
                <section class="inputs">
                    <div class="text-field">
                        <img src="./assets/icons/user.svg" alt="user"/>
                        <input type="text" placeholder="Nom d'utilisateur" name="pseudo" value="" required>
                    </div>
                    <div class="text-field">
                        <img src="./assets/icons/lock.svg" alt="lock">
                        <input type="password" placeholder="Mot de passe" name="mdp" value="" required>
                    </div>
                </section>
            </div>
            
            <div class="bottom-content">
                <div class="buttons">
                    <button type="button" id="goToInscription" class="secondary">
                        <img src="./assets/icons/user-circle.svg" alt="arrow">    
                        Inscription
                    </button>
                    <button type="submit">
                        <img src="./assets/icons/right-arrow.svg" alt="arrow">    
                        Me connecter
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>
<aside>
    <h2>VOTRE MUSIQUE PREFEREE</h2>
    <H2>LE TOUT A VOTRE PORTEE</H2>
</aside>

<!-- GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Flip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Observer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollToPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Draggable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/MotionPathPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/EaselPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/PixiPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/TextPlugin.min.js"></script>


<!-- RoughEase, ExpoScaleEase and SlowMo are all included in the EasePack file -->    
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/EasePack.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/CustomEase.min.js"></script>

<!-- Mon script -->
<script src="../Assets/Js/script_goto_inscription.js"></script>
