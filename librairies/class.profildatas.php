<?php

    class profilDatas {
        

        private $profilPersonneNum = -1;
        private $profilProjetsNum = array();
        private $infosProjets = array();
        private $infosPersonnes = array();

        
        public function _construct() {}

        public function set_profilPersonneNum($aNumber) { $this->profilPersonneNum = $aNumber; }
        public function get_profilPersonneNum() { return $this->profilPersonneNum; }
        
        public function set_profilProjetsNum($anArray) { $this->profilProjetsNum = $anArray; }
        public function get_profilProjetsNum() { return $this->profilProjetsNum; }
        
        public function add_ProjetInfos($anArray) {
            
            if (!array_key_exists($anArray['numero'],$this->infosProjets)) {
                $this->infosProjets[$anArray['numero']] = new unProjet();
            }
            
            $this->infosProjets[$anArray['numero']]->set_infos($anArray);
            
        }
        
        public function get_infosProjets($aNumber) { return $this->infosProjets[$aNumber]; }
        
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