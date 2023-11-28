<?php 
session_start();
include '../TD3&TD4/connect.php';
$name = $_SESSION['name'];
$sql = "SELECT series.title, series.poster 
            FROM user_series 
            JOIN user ON user.id = user_series.user_id
            JOIN series ON series.id = user_series.series_id
             WHERE user.name LIKE '$name' AND series.title LIKE '$serie->title'" ;

$query = $pdo->prepare($sql);
$query->execute();
if ($query->rowCount() == 0) {
    echo "<form action=\"../TD5/ajouterSerieSuivie.php\" method=\"get\">
                <input type=\"hidden\" name=\"favorie\" value=\"".$serie->title."\">
                <button type=\"submit\">Ajouter</button>
                </form>";
} else {
    echo "<form action=\"../TD5/retirerSerieSuivie.php\" method=\"get\">
                <input type=\"hidden\" name=\"favorie\" value=\"".$serie->title."\">
                <button type=\"submit\">Retirer</button>
                </form>";
}


?>