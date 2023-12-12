<?php
include '../TD3&TD4/connect.php';
$name = $_POST["identification"];
$password = $_POST["password"];
$sql="SELECT name FROM user WHERE name = '$name' and password = '$password'";
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
if($result){
    session_start();
    $_SESSION["name"] = $name;
    $_SESSION["password"] = $password;
    if($_SESSION['HTTP_REFERER'] == NULL){
        $_SESSION['HTTP_REFERER']=$_SERVER['HTTP_REFERER'];
    }
    if($_SESSION['HTTP_REFERER'] != 'http://localhost:8800/TD5/connexion.php' && $_SESSION['HTTP_REFERER'] != 'http://localhost:8800/TD5/deconnexion.php' &&
        $_SESSION['HTTP_REFERER'] != 'http://localhost:8800/TD2/accueil.php'){
        header("Location: " . $_SESSION['HTTP_REFERER']);
    }else if($_SESSION['HTTP_REFERER'] == 'http://localhost:8800/TD5/verify.php'){
        header('Location: ../TD3&TD4/formulaireBD.php');
    }
    else{
        header('Location: ../TD3&TD4/formulaireBD.php');
    }
   
}
else{
    echo "Erreur de connexion";
    
}
?>