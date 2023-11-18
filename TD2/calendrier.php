<!DOCTYPE html>
<html>
<head>
    <title>Calendrier</title>
    <meta charset="utf-8">
</head>
<body>
    <header>
        <form method="post">
            
            <?php
                $_POST['mois']='0';
                echo "<input name='";
                echo $_POST['mois'];
                echo "' type='submit' value='<'></input>";
                $annee=array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novenbre","Décembre");
                foreach ($_POST as $name => $value) {
                    if($value=="<") {
                        $_POST['mois'] = $name;
                        echo $annee[$_POST['mois']];
                    }
                    else if($value== '>') {
                        $_POST['mois'] = $name;
                        echo $annee[$_POST['mois']];
                    }
                 }
                echo "<input name='";
                echo $_POST['mois']+1;
                echo "' type='submit' value='>'></input>";
                foreach ($_POST as $name => $value) {
                    if($value==">") {
                    $_POST['mois'] = $name;
                    }
                 }
            ?>
            <form method="post">
            <select name="annee" onchange="this.form.submit()">
                <?php
                for($i=1970;$i<=2038;$i++){
                    if($i==$_POST["annee"]){
                        echo "<option value='$i' selected>$i</option>";
                    }
                    else{
                        echo "<option value='$i'>$i</option>";
                    }}
                ?>
            </select>

        </form>
        <table>
        <tr>
            <th></th>
            <th>Lundi</th>
            <th>Mardi</th>
            <th>Mercredi</th>
            <th>Jeudi</th>
            <th>Vendredi</th>
            <th>Samedi</th>
            <th>Dimanche</th>
        </tr>
        <tr>
            <?php
            if(isset($_POST['mois']) && isset($_POST['annee'])){
                $mois = $_POST['mois']+1;
                $annee = $_POST['annee'];
                $jour = date("w",mktime(0,0,0,$mois,0,$annee));
                $nbJour = date("t",mktime(0,0,0,$mois,1,$annee));
                $weekNumberstart = date('W', strtotime($annee.'-01-01'));
                $weekNumber=0;
                if($weekNumberstart==52){
                    $weekNumber = date('W',strtotime($annee.'-'.$mois.'-'.$jour))-1;
                }else{
                    $weekNumber = date('W',strtotime($annee.'-'.$mois.'-'.$jour));
                }
                if($weekNumber==0){
                    $weekNumber = 52;
                }
                $jourActuel = 1;
                $jourSuivant = 1;
                $jourPrecedent = 1;
                $jourPrecedent = $nbJour - $jour + 1;
                $jourSuivant = 1;
                for($i=0;$i<42;$i++){
                    if($i%7==0){
                        echo "</tr><tr><td>$weekNumber</td>";
                        $weekNumber++;
                        $weekNumber=$weekNumber%53;
                        if($weekNumber==0){
                            $weekNumber=1;
                        }
                    }
                    if($i<$jour){
                        echo "<td style='background-color:grey'>$jourPrecedent</td>";
                        $jourPrecedent++;
                    }
                    else if($jourActuel<=$nbJour){
                        echo "<td>$jourActuel</td>";
                        $jourActuel++;
                    }
                    else{
                        echo "<td style='background-color:grey'>$jourSuivant</td>";
                        $jourSuivant++;
                    }
                }
            }
            else{
                $mois = date("n");
                $annee = date("Y");
                $jour = date("w",mktime(0,0,0,$mois,1,$annee));
            };
            ?>

        </tr>

        </table>



        


    </header>
