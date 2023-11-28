<!DOCTYPE html>
<html>
<head>
    <title>formulaireBD</title>
    <meta charset="utf-8">
</head>
<body>
    <div>
        <?php
        session_start();
        include "../TD5/sessionverif.php";
        ?>
        <form action="afficherListeSerie.php" method="get">
            <label for="title">Critère initiale serie</label>
            <input type="text" name="title" id="titre">
            <button type="submit">recherche</button>
        </form>
        <a href="../TD5/afficherSerieSuivie.php">Serie favori</a>
        
    </div>
</body>
        