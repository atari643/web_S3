<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cookie</title>
</head>
<body>
    <?php
    if(isset($_COOKIE["nbVisite"])){
        $visite=$_COOKIE["nbVisite"]+1;
        setcookie("nbVisite",$visite);
        echo "Je t'ai vu ".$visite." fois";
    }else{
        setcookie("nbVisite",1);
        echo "Je t'ai vu ".$_COOKIE["nbVisite"]." fois";
    }
    ?>
</body>
</html>