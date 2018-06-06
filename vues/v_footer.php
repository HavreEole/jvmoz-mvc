        <footer>
            <span>Admins :
                
                <?php
                    $listAdminsTxt = '';
                    foreach ($footerInfos as $oneAdmin) {

                        $identite = ($oneAdmin['pseudo'] != '') ? $oneAdmin['pseudo'] : $oneAdmin['prenom'].' '.$oneAdmin['nom'];
                        
                        $listAdminsTxt .= '<a href="profil.php?num='.$oneAdmin['numero'].'">'.$identite.'</a>, ';

                    }
                    $listAdminsTxt = rtrim($listAdminsTxt,', ');
                    echo $listAdminsTxt;
                ?>
                
            </span>
        </footer>

    </body>        
</html>