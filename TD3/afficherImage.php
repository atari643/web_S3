<?php
    function __afficherImage($serie){
        header("content-type: image");
        echo "<img src=\"data:image/jpeg;base64,".base64_encode($serie->poster)."\"/>";
    }
    ?>

    