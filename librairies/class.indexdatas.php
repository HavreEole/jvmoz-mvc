<?php

    class indexDatas {
        

        private $selectedPersonnesNumeros = array();
        private $indexLength = array(0,8); // offset, lenght.
        private $menuLength = array(0,6); // offset, lenght.
        private $tagsFromUrlTxt = '';
        private $tagsFromUrlArray = array();
        private $tagsListeAffichee = array();
        private $titreHtml = '';
        private $voirPlus = false;
        private $infosPersonnes = array();
        
        
        public function _construct() {}
        
        public function set_selectedPersonnesNumeros($anArray) { $this->selectedPersonnesNumeros = $anArray; }
        public function get_selectedPersonnesNumeros() { return $this->selectedPersonnesNumeros; }
        
        public function set_indexLength($aNumber) { $this->indexLength[1] = $aNumber; }
        public function get_indexLength() { return $this->indexLength[1]; }
        
        public function set_menuLength($aNumber) { $this->menuLength[1] = $aNumber; }
        public function get_menuLength() { return $this->menuLength[1]; }
        
        public function set_tagsFromUrl($aTxtList,$anArrayList) {
            $this->tagsFromUrlTxt = $aTxtList;
            $this->tagsFromUrlArray = $anArrayList;
        }
        public function get_tagsFromUrlTxt() { return $this->tagsFromUrlTxt; }
        public function get_tagsFromUrlArray() { return $this->tagsFromUrlArray; }
        
        public function set_tagsListeAffichee($anArray) { $this->tagsListeAffichee = $anArray; }
        public function get_tagsListeAffichee() { return $this->tagsListeAffichee; }
        
        public function set_titreHtml($aTxt) { $this->titreHtml = $aTxt; }
        public function get_titreHtml() { return $this->titreHtml; }
        
        public function set_voirPlus($aNum) {
            $this->voirPlus = ( ($aNum - $this->indexLength[0]) > $this->indexLength[1] ) ? true : false ;
        }
        public function get_voirPlus() { return $this->voirPlus; }
        
        public function add_PersonneInfos($anArray) {
            
            if (!array_key_exists($anArray['numero'],$this->infosPersonnes)) {
                $this->infosPersonnes[$anArray['numero']] = new unePersonne();
            }
            
            $this->infosPersonnes[$anArray['numero']]->set_infos($anArray);
            
        }

        public function get_infosPersonnes() { return $this->infosPersonnes; }
        public function get_onePersonneInfo($aNumber) { return $this->infosPersonnes[$aNumber]; }
        
    }

?>