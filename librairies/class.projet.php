<?php

    class unProjet {
        
        private $numero;
        private $nom;
        private $studio;
        private $description;
        private $dateSortie;
        private $website;
        private $urlVisuel;
        private $tagList;
        private $equipe;
        
        public function _construct() {}
        
        public function set_infos($anArray) {
            
            if (isset($anArray['numero'])) { $this->numero = $anArray['numero']; }
            if (isset($anArray['nom'])) { $this->nom = $anArray['nom']; }
            if (isset($anArray['studio'])) { $this->studio = $anArray['studio']; }
            if (isset($anArray['description'])) { $this->description = $anArray['description']; }
            if (isset($anArray['dateSortie'])) { $this->dateSortie = $anArray['dateSortie']; }
            if (isset($anArray['website'])) { $this->website = $anArray['website']; }
            if (isset($anArray['urlVisuel'])) { $this->urlVisuel = $anArray['urlVisuel']; }
            if (isset($anArray['tagList'])) { $this->tagList = $anArray['tagList']; }
            
            if (isset($anArray['equipe'])) {
                
                $this->equipe = array();
                                      
                foreach ( $anArray['equipe'] as $unePersonne ) {
                    
                    $identite = ( $unePersonne['pseudo'] != '' )
                                ? $unePersonne['pseudo']
                                : $unePersonne['prenom'].' '.$unePersonne['nom'];

                    array_push($this->equipe,array('numero'=>$unePersonne['numero'],'identite'=>$identite));
                }
            }
        
        }
        
        public function get_projet() {
            
            return array(   'numero'=>$this->numero,
                            'nom'=>$this->nom,
                            'studio'=>$this->studio,
                            'description'=>$this->description,
                            'dateSortie'=>$this->dateSortie,
                            'website'=>$this->website,
                            'urlVisuel'=>$this->urlVisuel,
                            'tagList'=>$this->tagList,
                            'equipe'=>$this->equipe    );
            
        }
        
    }

?>