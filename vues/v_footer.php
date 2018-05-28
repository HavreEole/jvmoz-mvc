        <footer>
            <span>Admins :
                
                <?php
                    $listAdminsTxt = '';
                    foreach ($stockDatas->get_adminsFooterInfos() as $oneAdmin) {

                        $listAdminsTxt .= '<a href="profil.php?num='.$oneAdmin['numero'].'">'.$oneAdmin['identite'].'</a>, ';

                    }
                    $listAdminsTxt = rtrim($listAdminsTxt,', ');
                    echo $listAdminsTxt;
                ?>
                
            </span>
        </footer>

    </body>        
</html>