<?php 

include "connection.php";

$id = $_GET["id"];

$del = mysqli_query($conn, 'DELETE FROM vevo WHERE ID=' . $id);

if($conn){
    mysqli_close($conn);
    header("location:Vevok.php");
    exit;
}
else
{
    echo "Error deleting record";
    echo $id;
}

?>