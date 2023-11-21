<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page1</title>
</head>
<body>
    <?php
    session_start();
    include "sessionverif.php";
    echo "Bienvenue ".$_SESSION['name'];

    ?>
</body>
</html>