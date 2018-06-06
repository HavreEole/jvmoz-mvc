<?php

    class comptedatas {
        
        private $numero;
        private $email;
        private $mdp;
        private $admin;
        private $ban;
        private $prenom;
        private $pseudo;
        private $nom;
        private $twitter;
        private $linkedin;
        private $website;
        private $description;
        private $urlAvatar;
        private $tagsListNom;
        private $tagsListNum;
        private $allTags;
        private $projetsListNom;
        private $projetsListNum;
        private $projets;
        
        public function __construct() {
            $this->projetsListNom = array();
        }
        
        public function set_infos($anArray) {
            
            $this->numero = $anArray['numero'];
            $this->email = $anArray['email'];
            $this->mdp = $anArray['mdp'];
            $this->admin = $anArray['admin'];
            $this->ban = $anArray['ban'];
            $this->prenom = $anArray['prenom'];
            $this->pseudo = $anArray['pseudo'];
            $this->nom = $anArray['nom'];
            $this->twitter = $anArray['twitter'];
            $this->linkedin = $anArray['linkedin'];
            $this->website = $anArray['website'];
            $this->description = $anArray['description'];
            $this->urlAvatar = $anArray['urlAvatar'];
            
        }
        
        public function set_projetsListNum($anArray) { $this->projetsListNum = $anArray; }
        public function add_projetsListNom($aString) { array_push($this->projetsListNom,$aString); }
        
        public function set_tagsListNom($anArray) { $this->tagsListNom = $anArray; }
        public function set_tagsListNum($anArray) { $this->tagsListNum = $anArray; }
        public function set_allTags($anArray) { $this->allTags = $anArray; }
        
        public function add_ProjetInfos($aNum,$anArray) {
            if (!array_key_exists($aNum,$this->projets)) {
                $this->projets[$aNum] = new unProjet();
            }
            $this->projets[$aNum]->set_infos($anArray);
        }
        
        public function get_numero() { return $this->numero; }
        public function get_email() { return $this->email; }
        public function get_mdp() { return $this->mdp; }
        public function get_admin() { return $this->admin; }
        public function get_ban() { return $this->ban; }
        public function get_prenom() { return $this->prenom; }
        public function get_pseudo() { return $this->pseudo; }
        public function get_nom() { return $this->nom; }
        public function get_twitter() { return $this->twitter; }
        public function get_linkedin() { return $this->linkedin; }
        public function get_website() { return $this->website; }
        public function get_description() { return $this->description; }
        public function get_urlAvatar() { return $this->urlAvatar; }
        public function get_tagsListNom() { return $this->tagsListNom; }
        public function get_tagsListNum() { return $this->tagsListNum; }
        public function get_allTags() { return $this->allTags; }
        public function get_projetsListNom() { return $this->projetsListNom; }
        public function get_projetsListNum() { return $this->projetsListNum; }
        public function get_projets() { return $this->projets; }
        
    }