<?php
include "connection.php";
$id = $_POST["id"];
$Nev = $_POST["Nev"];
$Cim = $_POST["Cim"];
$Telefon = $_POST["Telefon"];

/* $sql_update = 'UPDATE termszolg SET 
    ID = ' . $id . ',
    Nev= "' . $Nev . '",
    Ar="' . $Ar . '",
    Leiras="' . $Leiras . '",
    WHERE ID =' . $id; */

$sql_update2 = 'UPDATE vevo SET 
    ID=' . $id . ',
    Név="' . $Nev . '",
    Cim="' . $Cim . '",
    Telefon="' . $Telefon . '"
    WHERE ID =' . $id;
if (mysqli_query($conn, $sql_update2)) {
    header("location:Vevok.php");
} else {
    mysqli_error($conn);
    include "header.php";
    include "errorMsg.php";
}
