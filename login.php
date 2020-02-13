<?php
    session_name("formulaire");
    session_start();
    include 'dbe_connect.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire</title>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php
    if(isset($_POST['username']) && isset($_POST['password'])){
        if($_POST['username']!=='' && $_POST['password']!==''){
            $user_login = $_POST['username'];
            $salt = "idjisjsiosi@5151@";
            $user_password = md5($_POST['password'].$salt);
            // $user_login='manon';
            // $user_password='manon';
            $sql = "select USERNAME,PASSWORD FROM t_login WHERE USERNAME='$user_login' AND PASSWORD='$user_password'"; //instruction/requete sql

            $result=$connection->query($sql); //demande a la base de donnée de executer la requete
            $resultrow=$result->fetch(PDO::FETCH_ASSOC); // on a demander a pdo de le mettre dans un tableau
            // print_r($resultrow);
            // echo $resultrow['USERNAME'];

            if($resultrow['USERNAME']!=""){
                $_SESSION['username'] = $resultrow['USERNAME'];
                header('Location: http://localhost/assurance-auto/index.php');
                //echo "je suis connecté";
                //print_r($resultrow); //montre la structure du tableau
            }else{
                echo '<div class="formulaire animatoo"><div class="formulaire-f"><p class="text">Mot de passe ou login incorrect</p>';
                echo '</br><a href="http://localhost/assurance-auto/form.php">Retour</a></div></div>';
                session_destroy();
            }

            // if($resultrow!==""){
            //     echo "pas vide";
            //     echo $resultrow['USERNAME'].'rrrrr';
            // }else{
            //     echo "vide";
            // }
            
            // foreach  ($connection->query($sql) as $row) {
            //     echo $row['USERNAME'];
            //     echo  $row['PASSWORD'];
            // }

        } else {
            header('Location: http://localhost/assurance-auto/form.php');
        }
    }
?>
</body>
</html>

