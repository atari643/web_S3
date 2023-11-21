<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Morpion</title>
</head>
<body>
<?php
    session_start();
    $tab=array();
    $tour=0;
    $user1=0;
    $user2=0;
    $statue="";
    if(!isset($_COOKIE['ID']) || !isset($_GET['ligne'])){
        $_SESSION['session']=rand();
        $_SESSION['user1']=rand();
        $_SESSION['user2']=rand();
        if (rand(0, 1) == 0) {
            $_SESSION['tour'] = $_SESSION['user1'];
        } else {
            $_SESSION['tour'] = $_SESSION['user2'];
        }
        setcookie("ID",$_SESSION['session']);
        for($i=0;$i<3;$i++){
            for($j=0;$j<3;$j++){
                $tab[$i][$j]="<a href=Morpion.php?ligne=".$i."&colonne=".$j.">Play</a>";
            }
        }
        $_SESSION["plateau"]=$tab;
        $tour=$_SESSION['tour'];
        $user1=$_SESSION['user1'];
        $user2=$_SESSION['user2'];
        if($tour==$user2){
            $_SESSION['status']= "user1: 'O', user2: 'X'";
        }else{
            $_SESSION['status']= "user1: 'X', user2: 'O'";

        }
        $statue=$_SESSION['status'];
        $tour="O";
        $_SESSION['tour']=$tour;
    }
    if (isset($_SESSION['session'])) {
        $tab=$_SESSION["plateau"];
        $tour=$_SESSION['tour'];
        $user1=$_SESSION['user1'];
        $user2=$_SESSION['user2'];
        $statue=$_SESSION['status'];
    }
    function verifMorpion($tab){
        $victoire=0;
        $egaliter=true;
        for($i=0;$i<3;$i++){
            for($j=0;$j<3;$j++){
                if($tab[$i][$j]=="<a href=Morpion.php?ligne=".$i."&colonne=".$j.">Play</a>"){
                    $egaliter=false;
                }
            }
        }
        if($egaliter){
            $victoire=2;
            return $victoire;
        }
        for($i=0;$i<3;$i++){
            if($tab[$i][0]==$tab[$i][1] && $tab[$i][1]==$tab[$i][2] && $tab[$i][0]!="<a href=Morpion.php?ligne=".$i."&colonne=0>Play</a>"){
                $victoire=1;
            }
        }
        for($i=0;$i<3;$i++){
            if($tab[0][$i]==$tab[1][$i] && $tab[1][$i]==$tab[2][$i] && $tab[0][$i]!="<a href=Morpion.php?ligne=0&colonne=".$i.">Play</a>"){
                $victoire=1;
            }
        }
        if($tab[0][0]==$tab[1][1] && $tab[1][1]==$tab[2][2] && $tab[0][0]!="<a href=Morpion.php?ligne=0&colonne=0>Play</a>"){
            $victoire=1;
        }
        if($tab[0][2]==$tab[1][1] && $tab[1][1]==$tab[2][0] && $tab[0][2]!="<a href=Morpion.php?ligne=0&colonne=2>Play</a>"){
            $victoire=1;
        }
        return $victoire;

    }
    if(isset($_GET['ligne']) && isset($_GET['colonne'])){
        if($tour=="O" && $tab[$_GET['ligne']][$_GET['colonne']]!="X"){
            $tab[$_GET['ligne']][$_GET['colonne']]="O";
            $tour="X";
        }else if($tour=="X" && $tab[$_GET['ligne']][$_GET['colonne']]!="O"){
            $tab[$_GET['ligne']][$_GET['colonne']]="X";
            $tour="O";
        }
        $_SESSION['plateau']=$tab;
        $_SESSION['tour']=$tour;

    }
    if(verifMorpion($tab)==1){
        if($tour=="O"){
            $statue="Victoire de X";
        }else{
            $statue="Victoire de O";
        }
        echo "<a href=Morpion.php>Rejouer</a>";
    }else if(verifMorpion($tab)==2){
        $statue="Egaliter";
        echo "<a href=Morpion.php>Rejouer</a>";
    }
    echo $statue;
    echo "<p> Au tour de ".$tour."</p>";
    if(verifMorpion($tab)==0){
    echo "<table>";
    for ($i = 0; $i < 3; $i++) {
        echo "<tr>";
        for ($j = 0; $j < 3; $j++) {
            echo "<td>".$tab[$i][$j]."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
    ?>
</body>
</html>