<?php 

include "connection.php";

$id = $_GET["id"];

$del = mysqli_query($conn, 'DELETE FROM kiadas WHERE ID=' . $id);

if($conn){
    mysqli_close($conn);
    header("location:Kiadas.php");
    exit;
}
else
{
    echo "Error deleting record";
    echo $id;
}

?>