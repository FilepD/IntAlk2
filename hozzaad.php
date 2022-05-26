<?php
if (isset($_POST["value"])) {
    $ertek = $_POST["value"];
    echo $ertek;
}else {
    echo "nem létezik";
}



?>
