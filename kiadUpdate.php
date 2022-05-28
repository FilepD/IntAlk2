<?php
include "connection.php";
$id = $_POST["id"];
$VevoID = $_POST["VevoID"];
$TermSzolgID = $_POST["TermSzolgID"];
$Mennyiség = $_POST["Mennyiség"];

/* $sql_update = 'UPDATE termszolg SET 
    ID = ' . $id . ',
    Nev= "' . $Nev . '",
    Ar="' . $Ar . '",
    Leiras="' . $Leiras . '",
    WHERE ID =' . $id; */

$sql_update2 = 'UPDATE kiadas SET 
    ID=' . $id . ',
    VevoID=' . $VevoID . ',
    TermSzolgID=' . $TermSzolgID . ',
    Mennyiség=' . $Mennyiség . '
    WHERE ID =' . $id;
if (mysqli_query($conn, $sql_update2)) {
    header("location:Kiadas.php");
} else {
    mysqli_error($conn);
    include "header.php";
    include "errorMsg.php";
}
