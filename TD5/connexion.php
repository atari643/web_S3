<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <?php
    session_start();
    $_SESSION["HTTP_REFERER"] = $_SERVER["HTTP_REFERER"];
    echo '<form method="post" action="verify.php">';
    echo '<label for="name">Identifiant</label>';
    echo '<input type="text" name=identification>';
    echo '<label for="password">password</label>';
    echo '<input type="password" name=password>';
    echo '<button type="submit" name="validate" id="validate">Validate</button>';
    ?>

</body>
</html>