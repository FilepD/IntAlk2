<?php 

include "connection.php";

$id = $_GET["id"];

$del = mysqli_query($conn, 'DELETE FROM termszolg WHERE ID=' . $id);

if($conn){
    mysqli_close($conn);
    header("location:Termszolg.php");
    exit;
}
else
{
    echo "Error deleting record";
    echo $id;
}

?>