<?php 

include "connection.php";

$id = $_GET["id"];

$del = mysqli_query($conn, 'DELETE FROM beszallito WHERE ID=' . $id);

if($conn){
    mysqli_close($conn);
    header("location:Beszallitok.php");
    exit;
}
else
{
    echo "Error deleting record";
    echo $id;
}

?>