<?php
include "connection.php";
$id = $_POST["id"];
$Nev = $_POST["Nev"];
$Ar = $_POST["Ar"];
$Leiras = $_POST["Leiras"];

$sql_update = 'UPDATE termszolg SET 
    ID = ' . $id . ',
    Nev= "' . $Nev . '",
    Ar="' . $Ar . '",
    Leiras="' . $Leiras . '",
    WHERE ID =' . $id;

$sql_update2 = 'UPDATE termszolg SET 
    ID=' . $id . ',
    Nev="' . $Nev . '",
    Ar=' . $Ar . ',
    Leiras="' . $Leiras . '"
    WHERE ID =' . $id;
if (mysqli_query($conn, $sql_update2)) {
    header("location:Termszolg.php");
} else {
    mysqli_error($conn);
    include "header.php";
    include "errorMsg.php";
}
