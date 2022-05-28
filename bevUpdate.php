<?php
include "connection.php";
$id = $_POST["id"];
$BeszallitoID = $_POST["BeszallitoID"];
$TermSzolgID = $_POST["TermSzolgID"];
$Mennyiség = $_POST["Mennyiség"];

/* $sql_update = 'UPDATE termszolg SET 
    ID = ' . $id . ',
    Nev= "' . $Nev . '",
    Ar="' . $Ar . '",
    Leiras="' . $Leiras . '",
    WHERE ID =' . $id; */

$sql_update2 = 'UPDATE bevetelezes SET 
    ID=' . $id . ',
    BeszallitoID=' . $BeszallitoID . ',
    TermSzolgID=' . $TermSzolgID . ',
    Mennyiség=' . $Mennyiség . '
    WHERE ID =' . $id;
if (mysqli_query($conn, $sql_update2)) {
    header("location:Bevetelezes.php");
} else {
    mysqli_error($conn);
    include "header.php";
    include "errorMsg.php";
}
