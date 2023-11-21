<!DOCTYPE html>
<html>
<head>
    <title>afficherListeSerie</title>
    <meta charset="utf-8">
</head>
<body>
    <div>
        <ul>
            <?php
            $numberPage = 1;
            include ("afficherImage.php");
            include ("CLASS_SERIES.php");
            session_start();
            include "../TD5/sessionverif.php";
            $title="*";
            $pdo=new PDO("mysql:dbname=etu_qartigala;host=info-titania","qartigala","5asTWrkD");
            $pdo->query('SET CHARSET UTF8');
            if(isset($_GET['numberPage'])){
                $numberPage = $_GET['numberPage'];
            }else{
                $numberPage = 1;
            }
            if(isset($_POST['titre'])){
                $titre = $_POST['titre'];
            }else{
                $titre = "*";
            }
            if(isset($_POST['title'])){
                $title = $_POST['title'];
                $sql = "SELECT title, poster FROM series WHERE title LIKE '$title%' LIMIT ".(($numberPage-1)*10).",10";
            }else{
                if($title!="*"){
                    $sql = "SELECT title, poster FROM series WHERE title LIKE '$title%' LIMIT ".(($numberPage-1)*10).",10";
                }
                else{
                    $sql = "SELECT title, poster FROM series LIMIT ".(($numberPage-1)*10).",10";
                }
            }if(isset($_GET['title'])){
                $title = $_GET['title'];
                $sql = "SELECT title, poster FROM series WHERE title LIKE '$title%' LIMIT ".(($numberPage-1)*10).",10";
            }else{
                if($title!="*"){
                    $sql = "SELECT title, poster FROM series WHERE title LIKE '$title%' LIMIT ".(($numberPage-1)*10).",10";
                }
                else{
                    $sql = "SELECT title, poster FROM series LIMIT ".(($numberPage-1)*10).",10";
                }
            }

            $query = $pdo->prepare($sql);
            $query->execute();
            $query->setFetchMode(PDO::FETCH_CLASS, 'Series');
            $series = $query->fetchAll();

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
            
            $sqlCount = "SELECT COUNT(*) FROM series WHERE title LIKE '$title%'";
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

            ?>

        </ul>
    </div>
    
</body>
</html>