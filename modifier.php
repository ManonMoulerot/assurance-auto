<?php
echo '<button type = "submit">Envoyer</button>';
            echo '</form>';     
            echo '<form action="" method="post" class="flex-column">';
            echo "<div><label>SELECTIONNER LA date de l'accident</label><input type='date' name = 'date-accident2'></div>";
            echo "<div><label>SELECTIONNER Le lieu de l'accident</label><input type='text' name = 'lieu2'></div>";
            echo "<div><label>SELECTIONNER La nature de l'accident</label><input type='text' name = 'nature2'></div>";
            echo "<div><label>SELECTIONNER Les dommages de l'accident</label><input type='text' name = 'dommage2'></div>";
            echo "<div><label>SELECTIONNER Les temoins de l'accident</label><input type='text' name = 'temoins2'></div>";
            echo "<div><label>SELECTIONNER Le nom de la ou des personnes impliquées</label><input type='text' name = 'nom-perso2'></div>";
            echo "<div><label>SELECTIONNER coordonnées de l'assurance</label><input type='text' name = 'coordonnees2'></div>";
            echo "<div><label>SELECTIONNER responsabilité</label><input type='text' name = 'responsabilite2'></div>";
            echo "<div><label>SELECTIONNER La date d'envoi du constat</label><input type='date' name = 'date_constat2'></div>";
            echo '<button type = "submit">Envoyer</button>';
            echo '</form>';

            if (isset($_POST['date_constat2']) && !empty($_POST['date_constat2'])){
                $client2=$_POST['client2'];
                $date_accident2=$_POST['date-accident2'];
                $lieu2=$_POST['lieu2'];
                $nature2=$_POST['nature2'];
                $dommage2=$_POST['dommage2'];
                $temoins2=$_POST['temoins2'];
                $nom_perso2=$_POST['nom-perso2'];
                $coordonnees2=$_POST['coordonnees2'];
                $responsablite2=$_POST['responsabilite2'];
                $date_constat2=$_POST['date_constat2'];
              
                $sql = "INSERT INTO t_accidents (id_contrat, DATE_ACCIDENT, LIEU, NATURE, DOMMAGE, TEMOINS, NOM_PERSONNE, COORDONNEES, RESPONSABILITE, DATE_CONSTAT) VALUES ('$client2','$date_accident2','$lieu2','$nature2','$dommage2','$temoins2','$nom_perso2','$coordonnees2','$responsablite2','$date_constat2');";
                $result=$connection->query($sql);}
?>

