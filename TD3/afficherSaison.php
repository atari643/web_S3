<!DOCTYPE html>
<html>
<head>
    <title>afficherSaison</title>
    <meta charset="utf-8">
</head>
<body>
<?php
    include("CLASS_SEASON.php");
    if(isset($_GET["title"])) {
        $title = $_GET["title"];
        $pdo=new PDO("mysql:dbname=etu_qartigala;host=info-titania","qartigala","5asTWrkD");
        $pdo->query('SET CHARSET UTF8');
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