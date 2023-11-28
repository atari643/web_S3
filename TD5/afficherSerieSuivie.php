<!DOCTYPE html>
<html>
<head>
    <title>afficherListeSerieSuvie</title>
    <meta charset="utf-8">
</head>
<body>
    <div>
        <ul>
            <?php
            $numberPage = 1;
            include ("../TD3&TD4/afficherImage.php");
            include ("../TD3&TD4/CLASS_SERIES.php");
            session_start();
            include "../TD5/sessionverif.php";
            if(isset($_SESSION['name'])){
            $name=$_SESSION['name'];
            $pdo=new PDO("mysql:dbname=etu_qartigala;host=info-titania","qartigala","5asTWrkD");
            $pdo->query('SET CHARSET UTF8');
            if(isset($_GET['numberPage'])){
                $numberPage = $_GET['numberPage'];
            }else{
                $numberPage = 1;
            }
            $sql = "SELECT series.title, series.poster 
            FROM user_series 
            JOIN user ON user.id = user_series.user_id
            JOIN series ON series.id = user_series.series_id
             WHERE user.name LIKE '$name' LIMIT ".(($numberPage-1)*10).",10";
            $query = $pdo->prepare($sql);
            $query->execute();
            $series = $query->fetchAll(PDO::FETCH_CLASS, 'SERIES');

            echo '<ul>';
            foreach($series as $serie){
                echo "<li>
                <a href=\"afficherSaison.php?title=".$serie->title."\">".$serie->title."</a></li>";
                __afficherImage($serie);
            }
            echo '</ul>';

            if($numberPage > 1){
                echo '<a href="afficherListeSerie.php?title='.$title.'&numberPage='.($numberPage-1).'">previous</a>';
            }
            if(count($series) == 10){
                echo '    <a href="afficherListeSerie.php?title='.$title.'&numberPage='.($numberPage+1).'">next</a>';
            }
            
            $sqlCount = "SELECT COUNT(*)
            FROM user_series 
            JOIN user ON user.id = user_series.user_id
            JOIN series ON series.id = user_series.series_id";
            $queryCount = $pdo->prepare($sqlCount);
            $queryCount->execute();
            $totalCount = $queryCount->fetchColumn();
            $totalPages = ceil($totalCount / 10);
            if(isset($_GET['numberPage'])){
                $currentPage = $_GET['numberPage'];
            }else{
                $currentPage = 1;
            }
            echo '<ul>';
            for($i = 1; $i <= $totalPages; $i++){
                if($i == $currentPage){
                    echo '<li>'.$i.'</li>';
                }else{
                    echo '<li><a href="afficherListeSerie.php?title='.$title.'&numberPage='.$i.'">'.$i.'</a></li>';
                }
            }
            echo '</ul>';
        }
            ?>

        </ul>
    </div>
    
</body>
</html>