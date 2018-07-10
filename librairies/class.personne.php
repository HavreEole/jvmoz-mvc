<?php

    class unePersonne {
        
        private $numero;
        private $ban;
        private $identite;
        private $links;
        private $description;
        private $urlAvatar;
        private $tagList;
        
        public function _construct() {
            $this->links = array();
        }
        
        public function set_infos($anArray) {
            
            if (isset($anArray['numero'])) { $this->numero = $anArray['numero']; }
            
            if (isset($anArray['pseudo']) || isset($anArray['nom'])) {
                if ( $anArray['pseudo'] != '' ) { $this->identite = $anArray['pseudo']; }
                else { $this->identite = $anArray['prenom'].' '.$anArray['nom']; }
            }
            
            if (isset($anArray['twitter'])) { $this->links['twitter'] = $anArray['twitter']; }
            if (isset($anArray['linkedin'])) { $this->links['linkedin'] = $anArray['linkedin']; }
            if (isset($anArray['website'])) { $this->links['website'] = $anArray['website']; }
            
            if (isset($anArray['description'])) { $this->description = $anArray['description']; }
            if (isset($anArray['urlAvatar'])) { $this->urlAvatar = $anArray['urlAvatar']; }
            
            if (isset($anArray['tagList'])) { $this->tagList = $anArray['tagList']; }
            
        }
        
        public function get_profil() {
            
            return array(   'numero'=>$this->numero,
                            'identite'=>$this->identite,
                            'links'=>$this->links,
                            'description'=>$this->description,
                            'urlAvatar'=>$this->urlAvatar,
                            'tagList'=>$this->tagList    );
            
        }
        
        public function get_listInfos() {
            
            $shortDesc = substr($this->description,0,85).'...';
            
            return array(   'numero'=>$this->numero,
                            'identite'=>$this->identite,
                            'description'=>$shortDesc,
                            'urlAvatar'=>$this->urlAvatar    );
            
        }
        
        public function get_Identite() { return $this->identite; }
        
    }

?>