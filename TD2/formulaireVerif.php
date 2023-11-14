<?php

function traitement($prenom, $nom, $email)
{
    echo 'Vous vous nommez ' . htmlspecialchars($prenom) . " " . htmlspecialchars($nom) . " et votre email est " . htmlspecialchars($email);
    echo '<hr/>';
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf8" />
        <title>Formulaire</title>
    </head>
    <body>
        <h1>Formulaire</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    if (isset($_POST['prenom']) && 
    isset($_POST['nom']) && 
    isset($_POST['email']) && 
    filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && 
    isset($_POST['genre']) &&
    isset($_POST['langages'])) 
    {
        // Le formulaire est valide et bien rempli, appel du traitement
        // sur les données
        traitement($_POST['prenom'], $_POST['nom'], $_POST['email']);
        echo 'Vous êtes un(e) ' . htmlspecialchars($_POST['genre']);
        echo '<hr>';
        echo ' Vous savez programmer en : ' . htmlspecialchars(implode(', ', $_POST['langages']));
        echo '<hr>';
    }
}
?>

<form method="post">
    Votre prénom&nbsp;:
    <input type="text" name="prenom" value="<?php if (isset($_POST['prenom'])) echo htmlspecialchars($_POST['prenom']);?>">

    Votre Nom&nbsp;:
    <input type="text" name="nom" value="<?php if (isset($_POST['nom'])) echo htmlspecialchars($_POST['nom']);?>">
    Votre Email&nbsp;:
    <input type="text" name="email" value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']);?>">
    Votre Genre&nbsp;:
    <!-- Menu déroulant -->
    <select name="genre">
        <option value="femme">Femme</option>
        <option value="homme">Homme</option>
        <option value="autre">Autre</option>
    </select>
    Vous savez programmer en&nbsp;:
    <!-- Cases à cocher déjà cocher -->
    <input type="checkbox" name="langages[]" value="html"/> HTML
    <input type="checkbox" name="langages[]" value="css" /> CSS
    <input type="checkbox" name="langages[]" value="js" /> JS
    <input type="checkbox" name="langages[]" value="php" /> PHP
    <br />
    <hr />

    <input type="submit" value="Envoyer" />
</form>
</body>
</html>