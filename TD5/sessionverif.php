<?php 
session_start();
if(!isset($_SESSION['name'])){
    echo "<a href='../TD5/connexion.php'>Connexion</a>";

}else{
    echo "<a href='../TD5/connexion.php'>Deconnexion</a>";
}
?>