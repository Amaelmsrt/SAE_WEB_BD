class ListeDattente {
    
    // Singleton
    static instance = null;

    // Utiliser le stockage local pour la liste, le son en cours et l'index
    listeKey = 'listeDattente';
    sonEnCoursKey = 'sonEnCours';
    numSonEnCoursKey = 'numSonEnCours';
    indexSonEnCoursKey = 'indexSonEnCours';
    
    liste = [];
    sonEnCours = null;
    numSonEnCours = null;
    indexSonEnCours = 0;

    static getInstance() {
        if (this.instance == null) {
            this.instance = new ListeDattente();
        }
        return this.instance;
    }

    // Constructeur
    constructor() {
        // Récupérer la liste, le son en cours et l'index depuis le stockage local lors de la création de l'instance
        this.retrieveDataFromLocalStorage();
    }

    // Mettre à jour le stockage local avec la liste, le son en cours et l'index actuels
    updateLocalStorage() {
        localStorage.setItem(this.listeKey, JSON.stringify(this.liste));
        localStorage.setItem(this.sonEnCoursKey, JSON.stringify(this.sonEnCours));
        localStorage.setItem(this.indexSonEnCoursKey, this.indexSonEnCours.toString());
        localStorage.setItem(this.numSonEnCoursKey, this.numSonEnCours);
    }

    // Récupérer la liste, le son en cours et l'index depuis le stockage local
    retrieveDataFromLocalStorage() {
        const storedList = localStorage.getItem(this.listeKey);
        const storedSonEnCours = localStorage.getItem(this.sonEnCoursKey);
        const storedIndexSonEnCours = localStorage.getItem(this.indexSonEnCoursKey);

        if (storedList) {
            this.liste = JSON.parse(storedList);
        }

        if (storedSonEnCours) {
            this.sonEnCours = JSON.parse(storedSonEnCours);
        }

        if (storedIndexSonEnCours) {
            this.indexSonEnCours = parseInt(storedIndexSonEnCours);
        }

        if (this.liste.length > 0) {
            this.numSonEnCours = this.liste[this.indexSonEnCours];
        }
    }

    // Set de l'index du son en cours
    setIndexSonEnCours(index) {
        this.indexSonEnCours = index;
        this.updateLocalStorage();
    }

    // Set son en cours
    setSonEnCours(son, numSon) {
        this.sonEnCours = son;
        this.numSonEnCours = numSon;
        this.updateLocalStorage();
    }

    // set liste
    setListe(liste) {
        this.liste = liste;
        this.updateLocalStorage();
    }

    addSon(id) {
        this.liste.push(id);
        this.updateLocalStorage();
    }

    removeSon(index) {
        this.liste.splice(index, 1);
        this.updateLocalStorage();
    }

    moveSon(index, direction) {
        const newIndex = index + direction;
        if (newIndex >= 0 && newIndex < this.liste.length) {
            const temp = this.liste[index];
            this.liste[index] = this.liste[newIndex];
            this.liste[newIndex] = temp;
            this.updateLocalStorage();
        }
    }
}
