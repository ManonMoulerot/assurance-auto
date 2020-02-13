<?php
    session_name("formulaire");
    session_start();
    include 'dbe_connect.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Liste</title>
</head>
<body>

<div class="formulaire1">
    <?php
        if ( isset($_SESSION['username']))
        {
            echo '<button class ="button" type="submit"><a href="http://localhost/assurance-auto/index.php">Retour</a></button><div class="text">Bonjour ' . $_SESSION['username'].'</div>';
        }
        else {
            header('Location: http://localhost/assurance-auto/form');
        }
    ?>
    <form action="deconnexion.php" method="post" >
        <input class ="button" type="submit" value = "Deconnecter">
    </form>
    </div>
<h1 class="titre-h1">ASSURTOUT</h1>
    <h2>Ajouter une intervention</h2>
    <form action="" method="post">
    <label>Selectionner le client</label><select name = "client">
            <?php
            $sql = "select NOM_CLIENT,ID_CLIENT FROM t_client"; //instruction/requete sql
            $result=$connection->query($sql); //demande a la base de donnée de executer la requete
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$resultrow['ID_CLIENT'].'">'.$resultrow['NOM_CLIENT'].'</option>';
            }
            ?>
            </select>
    <button type = "submit">Envoyer</button>
    </form>
    <?php
    if (isset($_POST['client'])){
    $client=$_POST['client'];
    echo '<form action="" method="post" class="flex-column">';
    echo '<div><label>SELECTIONNER LE CONTRAT</label><select name = "contrat">';
    $sql2 = "select id_client,ID_CONTRAT,TYPE_CONTRAT from t_contrat WHERE id_client = '$client'"; //instruction/requete sql
    $result=$connection->query($sql2); //demande a la base de donnée de executer la requete
    while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$resultrow['ID_CONTRAT'].'">'.$resultrow['TYPE_CONTRAT'].'</option>';
    }
    echo '</select></div>';
    $sql3 = "select NOM_EXPERT,ID_EXPERT from t_expert"; //instruction/requete sql
    $result=$connection->query($sql3); //demande a la base de donnée de executer la requete
    echo '<div><label>SELECTIONNER Lexpert</label><select name = "expert">';
    while ($resultrow2=$result->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$resultrow2['ID_EXPERT'].'">'.$resultrow2['NOM_EXPERT'].'</option>';
    }
    echo '</select></div>';
    echo "<div><label>SELECTIONNER LA date de l'expertise</label><input type='date' name = 'date-expertise'></div>";
    echo "<div><label>Entrer Le rapport de l'expertise</label><input type='text' name = 'rapport'></div>";
    echo "<div><label>Entrer L'évaluation d'indemnisation'</label><input type='text' name = 'eval'></div>";
    echo "<div><label>Entrerla franchise</label><input type='text' name = 'franchise'></div>";
    echo "<div><label>Entrer l'indemnisation</label><input type='text' name = 'indemnisation'></div>";
    echo '<button type = "submit">Envoyer</button>';
    echo '</form>';  
    }

    if (isset($_POST['expert']) && !empty($_POST['expert'])){
        $expert=$_POST['expert'];
        $date_expertise=$_POST['date-expertise'];
        $rapport=$_POST['rapport'];
        $eval=$_POST['eval'];
        $franchise=$_POST['franchise'];
        $indemnisation=$_POST['indemnisation'];
        $contrat=$_POST['contrat'];
        $sql4 = "select * from t_contrat inner join t_accidents on t_accidents.id_contrat=t_contrat.ID_CONTRAT where t_contrat.ID_CONTRAT=$contrat"; //instruction/requete sql
        $result=$connection->query($sql4); //demande a la base de donnée de executer la requete
        while ($resultrow4=$result->fetch(PDO::FETCH_ASSOC)) {
            $id_accident=$resultrow4['ID_ACCIDENT'];
        }
        $sql = "INSERT INTO t_intervention (id_accident, id_expert, DATE_EXPERTISE, RAPPORT_EXPERTISE, EVAL_INDEMNISATION, FRANCHISE, INDEMNISATION) VALUES ('$id_accident','$expert','$date_expertise','$rapport','$eval','$franchise','$indemnisation');";
        $result=$connection->query($sql);}

    ?>




<h2>Modifier</h2>
<form action="" method="post">
    <label>Selectionner le client</label><select name = "client2">
            <?php
            $sql = "select NOM_CLIENT,ID_CLIENT FROM t_client"; //instruction/requete sql
            $result=$connection->query($sql); //demande a la base de donnée de executer la requete
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$resultrow['ID_CLIENT'].'">'.$resultrow['NOM_CLIENT'].'</option>';
            }
            ?>
            </select>
    <?php
    echo '<div><label>SELECTIONNER LE CONTRAT</label><select name = "contrat2">';
    $sql2 = "select id_client,ID_CONTRAT,TYPE_CONTRAT from t_contrat"; //instruction/requete sql
    $result=$connection->query($sql2); //demande a la base de donnée de executer la requete
    while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$resultrow['ID_CONTRAT'].'">'.$resultrow['TYPE_CONTRAT'].'</option>';
    }
    echo '</select></div>';
    $sql3 = "select DATE_EXPERTISE,ID from t_intervention"; //instruction/requete sql
    $result=$connection->query($sql3); //demande a la base de donnée de executer la requete
    echo '<div><label>SELECTIONNER La date d"expertise</label><select name = "date2">';
    while ($resultrow2=$result->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$resultrow2['DATE_EXPERTISE'].'">'.$resultrow2['DATE_EXPERTISE'].'</option>';
    }
    echo '</select>';
    echo '<button type = "submit">Envoyer</button>';
    echo '   </form>';

    if (isset($_POST['date2']) && !empty($_POST['date2'])){
        $contrat2=$_POST['contrat2'];
        $client2=$_POST['client2'];
        $date2=$_POST['date2'];
        $sql4 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat inner join t_intervention on t_accidents.ID_ACCIDENT=t_intervention.id_accident where $contrat2=t_contrat.ID_CONTRAT and  $client2=t_contrat.id_client and '$date2'=t_intervention.DATE_EXPERTISE"; //instruction/requete sql
        $result=$connection->query($sql4); //demande a la base de donnée de executer la requete
        while ($resultrow4=$result->fetch(PDO::FETCH_ASSOC)) {    
            $sql3 = "select NOM_EXPERT,ID_EXPERT from t_expert"; //instruction/requete sql
            $result=$connection->query($sql3); //demande a la base de donnée de executer la requete
            echo '<div><label>SELECTIONNER Lexpert</label><select name = "expert2">';
            while ($resultrow2=$result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$resultrow2['ID_EXPERT'].'">'.$resultrow2['NOM_EXPERT'].'</option>';
            }
            echo '</select></div>';
            echo "<div><label>SELECTIONNER LA date de l'expertise</label><input type='date' name = 'date-expertise2' value='".$resultrow4['DATE_EXPERTISE']."'></div>";
            echo "<div><label>Entrer Le rapport de l'expertise</label><input type='text' name = 'rapport2' value='".$resultrow4['RAPPORT_EXPERTISE']."'></div>";
            echo "<div><label>Entrer L'évaluation d'indemnisation'</label><input type='text' name = 'eval2' value='".$resultrow4['EVAL_INDEMNISATION']."'></div>";
            echo "<div><label>Entrerla franchise</label><input type='text' name = 'franchise2' value='".$resultrow4['FRANCHISE']."'></div>";
            echo "<div><label>Entrer l'indemnisation</label><input type='text' name = 'indemnisation2' value='".$resultrow4['INDEMNISATION']."'></div>";
            echo '<button type = "submit">Envoyer</button>';
            echo '</form>'; 
                
            }
        }

    if (isset($_POST['expert2']) && !empty($_POST['expert2'])){
  
    $sql5 = "update t_intervention set DATE_EXPERTISE = '".$_POST['date-expertise2']."', RAPPORT_EXPERTISE = '".$_POST['rapport2']."', 
    EVAL_INDEMNISATION = '".$_POST['eval2']."', FRANCHISE = '".$_POST['franchise2']."', 
    INDEMNISATION = '".$_POST['indemnisation2']."'";
    $result=$connection->query($sql5);}
?>


<h2>Supprimer</h2>
<form action="" method="post">
    <label>Selectionner le client</label><select name = "client2">
            <?php
            $sql = "select NOM_CLIENT,ID_CLIENT FROM t_client"; //instruction/requete sql
            $result=$connection->query($sql); //demande a la base de donnée de executer la requete
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$resultrow['ID_CLIENT'].'">'.$resultrow['NOM_CLIENT'].'</option>';
            }
            ?>
            </select>
    <?php
    echo '<div><label>SELECTIONNER LE CONTRAT</label><select name = "contrat2">';
    $sql2 = "select id_client,ID_CONTRAT,TYPE_CONTRAT from t_contrat"; //instruction/requete sql
    $result=$connection->query($sql2); //demande a la base de donnée de executer la requete
    while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$resultrow['ID_CONTRAT'].'">'.$resultrow['TYPE_CONTRAT'].'</option>';
    }
    echo '</select></div>';
    $sql3 = "select DATE_EXPERTISE,ID from t_intervention"; //instruction/requete sql
    $result=$connection->query($sql3); //demande a la base de donnée de executer la requete
    echo '<div><label>SELECTIONNER La date d"expertise</label><select name = "date2">';
    while ($resultrow2=$result->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$resultrow2['DATE_EXPERTISE'].'">'.$resultrow2['DATE_EXPERTISE'].'</option>';
    }
    echo '</select>';
    echo '<button type = "submit">Envoyer</button>';
    echo '   </form>';

    if (isset($_POST['date2']) && !empty($_POST['date2'])){
        $contrat2=$_POST['contrat2'];
        $client2=$_POST['client2'];
        $date2=$_POST['date2'];
        $sql4 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat inner join t_intervention on t_accidents.ID_ACCIDENT=t_intervention.id_accident where $contrat2=t_contrat.ID_CONTRAT and  $client2=t_contrat.id_client and '$date2'=t_intervention.DATE_EXPERTISE"; //instruction/requete sql
        $result=$connection->query($sql4); //demande a la base de donnée de executer la requete
        while ($resultrow4=$result->fetch(PDO::FETCH_ASSOC)) {
            $ID=$resultrow4['ID'];
            $sql5 = "DELETE FROM `t_intervention`  WHERE ID= $ID";
            $result=$connection->query($sql5);}
        }

    ?>
<h2>Rechercher</h2>
<form action="" method="post">
    <label>Selectionner le client</label><select name = "client3">
            <?php
            $sql = "select NOM_CLIENT,ID_CLIENT FROM t_client"; //instruction/requete sql
            $result=$connection->query($sql); //demande a la base de donnée de executer la requete
            echo "<option selected='selected'></option>";
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$resultrow['ID_CLIENT'].'">'.$resultrow['NOM_CLIENT'].'</option>';
            }
            ?>
            </select>
    <?php
    echo '<div><label>SELECTIONNER LE CONTRAT</label><select name = "contrat3">';
    $sql2 = "select id_client,ID_CONTRAT,TYPE_CONTRAT from t_contrat"; //instruction/requete sql
    $result=$connection->query($sql2); //demande a la base de donnée de executer la requete
    echo "<option selected='selected'></option>";
    while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$resultrow['ID_CONTRAT'].'">'.$resultrow['TYPE_CONTRAT'].'</option>';
    }
    echo '</select></div>';
    $sql3 = "select DATE_EXPERTISE,ID from t_intervention"; //instruction/requete sql
    $result=$connection->query($sql3); //demande a la base de donnée de executer la requete
    echo '<div><label>SELECTIONNER La date d"expertise</label><select name = "date3">';
    echo "<option selected='selected'></option>";
    while ($resultrow2=$result->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$resultrow2['DATE_EXPERTISE'].'">'.$resultrow2['DATE_EXPERTISE'].'</option>';
    }
    echo '</select>';
    echo '<button type = "submit">Envoyer</button>';
    echo '   </form>';
            if (isset($_POST['client3']) && !empty($_POST['client3']) && isset($_POST['contrat3']) && !empty($_POST['contrat3']) && isset($_POST['date3']) && !empty($_POST['date3'])){
                $client3=$_POST['client3'];
                $contrat3=$_POST['contrat3'];
                $date3=$_POST['date3'];
                $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat inner join t_intervention on t_accidents.ID_ACCIDENT=t_intervention.id_accident where $contrat3=t_contrat.ID_CONTRAT and  $client3=t_contrat.id_client and '$date3'=t_intervention.DATE_EXPERTISE"; //instruction/requete sql
                $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
                echo "<ul>";
                while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {    
                    echo "<li>".$resultrow['NOM_CLIENT']." ".$resultrow['TYPE_CONTRAT']." ".$resultrow['DATE_EXPERTISE']." ".$resultrow['DATE_ACCIDENT']." ".$resultrow['RAPPORT_EXPERTISE']." ".$resultrow['EVAL_INDEMNISATION']." ".$resultrow['FRANCHISE']." ".$resultrow['INDEMNISATION']."</li>"; 
                }
                echo "</ul>";
            }
            else if (isset($_POST['client4']) && empty($_POST['client4']) && isset($_POST['date4']) && empty($_POST['date4']) && isset($_POST['contrat4']) && empty($_POST['contrat4'])){
    
                $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat"; //instruction/requete sql
                $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
                echo "<ul>";
                while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<li>".$resultrow['NOM_CLIENT']." ".$resultrow['DATE_ACCIDENT']." ".$resultrow['LIEU']." ".$resultrow['NATURE']." ".$resultrow['DOMMAGE']." ".$resultrow['TEMOINS']." ".$resultrow['NOM_PERSONNE']." ".$resultrow['COORDONNEES']." ".$resultrow['RESPONSABILITE']." ".$resultrow['DATE_CONSTAT']."</li>";
                }
                echo "</ul>";
            }
            else if (isset($_POST['client4']) && !empty($_POST['client4']) && isset($_POST['date4']) && !empty($_POST['date4'])){
                $client4=$_POST['client4'];
                $date4=$_POST['date4'];
                $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat where $client4=t_contrat.id_client and '$date4'=t_accidents.DATE_ACCIDENT"; //instruction/requete sql
                $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
                echo "<ul>";
                while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<li>".$resultrow['NOM_CLIENT']." ".$resultrow['DATE_ACCIDENT']." ".$resultrow['LIEU']." ".$resultrow['NATURE']." ".$resultrow['DOMMAGE']." ".$resultrow['TEMOINS']." ".$resultrow['NOM_PERSONNE']." ".$resultrow['COORDONNEES']." ".$resultrow['RESPONSABILITE']." ".$resultrow['DATE_CONSTAT']."</li>";
                }
                echo "</ul>";
            }
            else if (isset($_POST['client4']) && !empty($_POST['client4']) && isset($_POST['contrat4']) && !empty($_POST['contrat4'])){
                $client4=$_POST['client4'];
                $contrat4=$_POST['contrat4'];
                $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat where $client4=t_contrat.id_client AND $contrat4=t_contrat.ID_CONTRAT"; //instruction/requete sql
                $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
                echo "<ul>";
                while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {    
                    echo "<li>".$resultrow['NOM_CLIENT']." ".$resultrow['DATE_ACCIDENT']." ".$resultrow['LIEU']." ".$resultrow['NATURE']." ".$resultrow['DOMMAGE']." ".$resultrow['TEMOINS']." ".$resultrow['NOM_PERSONNE']." ".$resultrow['COORDONNEES']." ".$resultrow['RESPONSABILITE']." ".$resultrow['DATE_CONSTAT']."</li>"; 
                }
                echo "</ul>";
            }
            else if (isset($_POST['client4']) && !empty($_POST['client4'])){
                $client4=$_POST['client4'];
                $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat where $client4=t_contrat.id_client"; //instruction/requete sql
                $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
                echo "<ul>";
                while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {    
                    echo "<li>".$resultrow['NOM_CLIENT']." ".$resultrow['DATE_ACCIDENT']." ".$resultrow['LIEU']." ".$resultrow['NATURE']." ".$resultrow['DOMMAGE']." ".$resultrow['TEMOINS']." ".$resultrow['NOM_PERSONNE']." ".$resultrow['COORDONNEES']." ".$resultrow['RESPONSABILITE']." ".$resultrow['DATE_CONSTAT']."</li>"; 
                }
                echo "</ul>";
            }
            else if (isset($_POST['contrat4']) && !empty($_POST['contrat4'])){
                $contrat4=$_POST['contrat4'];
                $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat where $contrat4=t_contrat.ID_CONTRAT"; //instruction/requete sql
                $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
                echo "<ul>";
                while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {    
                    echo "<li>".$resultrow['NOM_CLIENT']." ".$resultrow['DATE_ACCIDENT']." ".$resultrow['LIEU']." ".$resultrow['NATURE']." ".$resultrow['DOMMAGE']." ".$resultrow['TEMOINS']." ".$resultrow['NOM_PERSONNE']." ".$resultrow['COORDONNEES']." ".$resultrow['RESPONSABILITE']." ".$resultrow['DATE_CONSTAT']."</li>"; 
                }
                echo "</ul>";
            }
            else if (isset($_POST['date4']) && !empty($_POST['date4'])){
                $date4=$_POST['date4'];
                $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat where '$date4'=t_accidents.DATE_ACCIDENT"; //instruction/requete sql
                $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
                echo "<ul>";
                while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {    
                    echo "<li>".$resultrow['NOM_CLIENT']." ".$resultrow['DATE_ACCIDENT']." ".$resultrow['LIEU']." ".$resultrow['NATURE']." ".$resultrow['DOMMAGE']." ".$resultrow['TEMOINS']." ".$resultrow['NOM_PERSONNE']." ".$resultrow['COORDONNEES']." ".$resultrow['RESPONSABILITE']." ".$resultrow['DATE_CONSTAT']."</li>"; 
                }
                echo "</ul>";
            } else {
    
            }
    ?>
</body>
</html>