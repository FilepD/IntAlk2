<?php 

include "connection.php";

$id = $_GET["id"];

$del = mysqli_query($conn, 'DELETE FROM bevetelezes WHERE ID=' . $id);

if($conn){
    mysqli_close($conn);
    header("location:Bevetelezes.php");
    exit;
}
else
{
    echo "Error deleting record";
    echo $id;
}

?>