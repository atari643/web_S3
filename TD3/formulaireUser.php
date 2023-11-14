<!DOCTYPE html>
<html>
<head>
    <title>formulaireUser</title>
    <meta charset="utf-8">
</head>
<body>
    <form method="post" action="insertionBD.php">
        <label for="name">Votre nom</label>
        <input type="text" name="name" id="name">
        <label for="email">Votre email</label>
        <input type="email" name="email" id="email">
        <label for="password">Votre Password</label>
        <input type="password" name="password" id="password">
        <label for="pays">Votre Pays</label>
        <select name="countrys" id="country-select">
        <option value="">--Please choose an option--</option>
        <?php 
        $pdo=new PDO("mysql:dbname=etu_qartigala;host=info-titania","qartigala","5asTWrkD");
        $pdo->query('SET CHARSET UTF8');
        $sql ="Select name from country";
        $query = $pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            echo "<option value=".$row["name"].">".$row["name"]."</option>";
        }
        ?>
        </select>
        <input type="text" placeholder="Autre..." name="otherCountry" />
        <button type="submit" name="validate" id="validate">Validate</button>
    </form>
</body>