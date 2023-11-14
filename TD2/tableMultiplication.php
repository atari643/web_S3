<!DOCTYPE html>
<html>
<head>
    <title>Table de multiplication</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Table de multiplication</h1>
    <table>
        <tr>
            <?php for( $i = 1; $i < 10; $i++ ){
                echo "<th>$i</th>";
            };?>
        </tr>
        <tr>
            <?php for( $i = 2; $i < 10; $i++ ){
                echo "<tr>";
                echo "<th>$i</th>";
                for( $j = 2; $j <10; $j++ ){
                    echo"<td>";
                    if($_GET['n1']==$i || $_GET['n2']==$j){
                        echo "<a style='background-color:yellow' href='?n1=$i&n2=$j'>";
                        echo $i*$j;
                        echo "</a></td>";
                    }
                    else{
                    echo "<a href='?n1=$i&n2=$j'>";
                    echo $i*$j;
                    echo "</a></td>";
                    };
                }
                echo "</tr>";
            };?>

        </tr>
    </table>