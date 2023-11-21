<!DOCTYPE html>
<html>
<head>
    <title>afficherSaison</title>
    <meta charset="utf-8">
</head>
<body>
<?php
    include("CLASS_SEASON.php");
    session_start();
    include "../TD5/sessionverif.php";
    if(isset($_GET["title"]) && isset($_SESSION["name"])) {
        $title = $_GET["title"];
        include 'connect.php';
        $sql ="SELECT `season`.`number`, COUNT(*) as numberEpisode
        FROM `episode` 
            LEFT JOIN `season` ON `season`.`id` = `episode`.`season_id` 
            LEFT JOIN `series` ON `series`.`id` = `season`.`series_id`
        WHERE series.id=(Select id from series where title='$title')
        GROUP BY `season`.`number`";
        $query = $pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_CLASS, "Season");
        echo("<h1>$title</h1>");
        foreach($result as $season){
            echo "<li>
            season : ".$season->number." episode : ".$season->numberEpisode."
            </li>";
        }

    

    }

?>
</body>
</html>