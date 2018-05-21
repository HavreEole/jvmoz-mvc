<?php

    class listes {
        
        /* Utilisé dans Index */
        private $selectedPersonnesNumeros = array();
        private $indexLength = array(0,8); // offset, lenght.
        private $menuLength = array(0,6); // offset, lenght.
        private $tagsFromUrlTxt = '';
        private $tagsFromUrlArray = array();
        private $tagsListeAffichee = array();
        private $titreHtml = '';
        private $voirPlus = false;
        
        /* Utilisé dans Profil */
        private $profilPersonneNum = -1;
        private $profilProjetsNum = array();
        private $infosProjets = array();
        
        /* Utilisé dans les deux */
        private $infosPersonnes = array();
        private $numerosAdmins = array();
        
        
        
        /*** Méthodes ***/
        
        public function _construct() {}
        
        
        
        /* Utilisé dans Index */
        
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
        
        
        
        /* Utilisé dans Profil */
        
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
        
        
        
        /* Utilisé dans les deux */
        
        public function add_PersonneInfos($anArray) {
            
            if (!array_key_exists($anArray['numero'],$this->infosPersonnes)) {
                $this->infosPersonnes[$anArray['numero']] = new unePersonne();
            }
            
            $this->infosPersonnes[$anArray['numero']]->set_infos($anArray);
            
        }

        public function get_infosPersonnes() { return $this->infosPersonnes; }
        public function get_onePersonneInfo($aNumber) { return $this->infosPersonnes[$aNumber]; }
        
        public function set_numerosAdmins($anNumber) {
                array_push($this->numerosAdmins,$anNumber);
        }
        
        public function get_adminsFooterInfos() {

            $listAdminsInfos = array();
            
            foreach ($this->numerosAdmins as $oneAdminNumero) {
                
                $oneAdminInfos = $this->infosPersonnes[$oneAdminNumero]->get_footerInfos();
                array_push($listAdminsInfos,$oneAdminInfos);
                
            }
     
            return $listAdminsInfos;
        }
        
        
        
        /*
        public function saveInfosSession() {
            
            $myInfos = array();
            
            $myInfos['selectedPersonnesNumeros'] = $this->selectedPersonnesNumeros;
            $myInfos['indexLength'] = $this->indexLength;
            $myInfos['menuLength'] = $this->menuLength;
            $myInfos['tagsListeAffichee'] = $this->tagsListeAffichee;
            $myInfos['titreHtml'] = $this->titreHtml;
            $myInfos['voirPlus'] = $this->voirPlus;
            
            return $myInfos;
            
        }
        
        public function loadInfosSession($myInfos) {
            
            $this->selectedPersonnesNumeros = $myInfos['selectedPersonnesNumeros'];
            $this->indexLength = $myInfos['indexLength'];
            $this->menuLength = $myInfos['menuLength'];
            $this->tagsListeAffichee = $myInfos['tagsListeAffichee'];
            $this->titreHtml = $myInfos['titreHtml'];
            $this->voirPlus = $myInfos['voirPlus'];
            
        }
        */
    }

?>