<!DOCTYPE html>
<html>
<head>
    <title>Calculatrice</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Calculatrice</h1>
    <form method="get">
        <input type="text" name="n1" value="<?php echo $_GET['n1'] ?? 0 ?>">
        +
        <input type="text" name="n2" value="<?php echo $_GET['n2'] ?? 0 ?>">
        <input type="submit" value="Calculer">
        <?php
        if(isset($_GET['n1']) && isset($_GET['n2'])){
                echo $_GET['n1'] + $_GET['n2'];
        }
        ?>
    </form>