<?php

    class indexDatas {
        

        private $selectedPersonnesNumeros = array();
        private $tagsFromUrlTxt = '';
        private $tagsFromUrlArray = array();
        private $tagsListeAffichee = array();
        private $titreHtml = '';
        private $infosPersonnes = array();
        
        
        public function _construct() {}
        
        public function set_selectedPersonnesNumeros($anArray) { $this->selectedPersonnesNumeros = $anArray; }
        public function get_selectedPersonnesNumeros() { return $this->selectedPersonnesNumeros; }
        
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