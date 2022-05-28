<!DOCTYPE html>
<html lang="en">
<?php
require_once "connection.php";
require_once "header.php";
require_once "head.php"
?>


<body>
    <div class="container-fluid">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-row">
            <div class="col-1">Termékek és Szolgáltatások</div>
                <div class="col-2">
                    <input type="text" class="form-control" id="InputNev" placeholder="Név" name="InputNev">
                </div>
                <div class="col-2">
                    <input type="number" class="form-control" id="InputAr" placeholder="Ár" name="InputAr">
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" id="InputLeiras" placeholder="Leírás" name="InputLeiras">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary">Hozzáad</button>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $sql = "SELECT MAX(ID) FROM termszolg";
                        $records = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($records) < 0) {
                            $ID = 1;
                        } else {
                            $row = mysqli_fetch_row($records);
                            $ID = $row[0] + 1;
                        }
                        $sqlInsert = "INSERT INTO termszolg (ID, Nev, Ar, Leiras) VALUES (?,?,?,?)";
                        $Nev =  $_POST["InputNev"];
                        $Ar =  $_POST["InputAr"];
                        $Leiras =  $_POST["InputLeiras"];

                        if ($stmt = mysqli_prepare($conn, $sqlInsert)) {
                            mysqli_stmt_bind_param($stmt, "isis", $param_ID, $param_Nev, $param_Ar, $param_Leiras);
                            $param_ID = (int)$ID;
                            $param_Nev = $Nev;
                            $param_Ar = (int)$Ar;
                            $param_Leiras = $Leiras;
                            // if (mysqli_stmt_execute($stmt)) {
                            //     echo "megy";
                            // }else {
                            //     echo "nem megy";
                            // }
                            $stmt->execute();
                            $param_ID = null;
                            $param_Nev = null;
                            $param_Ar = null;
                            $param_Leiras = null;
                            mysqli_stmt_close($stmt);
                        }
                    }
                    ?>
                </div>
                <div class="container" id="errorMessage"></div>
            </div>
        </form>
    </div> <!-- formnak -->
    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Név</th>
                    <th>Ár</th>
                    <th>Mennyiség</th>
                    <th>Összár</th>
                    <th>Leírás</th>
                    <th>Módosít</th>
                    <th>Töröl</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM termszolg";
                $records = mysqli_query($conn, $sql);


                if (mysqli_num_rows($records) > 0) {
                    while ($row = mysqli_fetch_assoc($records)) {
                        echo '<tr>',
                        '<td>', $row["ID"], '</td>',
                        '<td>', $row["Nev"], '</td>',
                        '<td>', $row["Ar"], '</td>',
                        '<td>', dinamikus($row["ID"], $conn), '</td>',
                        '<td>', osszar($row["ID"],$row["Ar"], $conn), '</td>',
                        '<td>', $row["Leiras"], '</td>',
                        '<td><a href="UpdateForm.php?id=' . $row["ID"] . '" class="btn btn-primary btn-sm max">Módosítás</a></td>',
                        '<td><a href="delete.php?id=' . $row["ID"] . '" class="btn btn-danger btn-sm max">Törlés</a></td>',
                        '</tr>';
                    }
                } else {
                    echo "0 results ";
                }
                function dinamikus($ID, $conn)
                {

                    $bevsql = "SELECT SUM(Mennyiség) as sum FROM bevetelezes WHERE TermSzolgID =" . $ID;
                    $kiadsql = "SELECT SUM(Mennyiség) as sum FROM kiadas WHERE TermSzolgID =" . $ID;
                    $bevquery = mysqli_query($conn, $bevsql);
                    $kiadquery = mysqli_query($conn, $kiadsql);

                    if (mysqli_num_rows($bevquery) > 0) {
                        if (mysqli_num_rows($kiadquery)<=0) {
                          echo mysqli_fetch_assoc($bevquery)["sum"];
                        } else {
                            $bevmenny = mysqli_fetch_assoc($bevquery);
                            $kiadmenny = mysqli_fetch_assoc($kiadquery);
                            $szamol = $bevmenny["sum"]-$kiadmenny["sum"];
                            echo $szamol;
                        }
                    } else {
                        echo "nulla elem";
                    }
                }
                function osszar($ID, $Ar, $conn){
                    $bevsql = "SELECT SUM(Mennyiség) as sum FROM bevetelezes WHERE TermSzolgID =" . $ID;
                    $kiadsql = "SELECT SUM(Mennyiség) as sum FROM kiadas WHERE TermSzolgID =" . $ID;
                    $bevquery = mysqli_query($conn, $bevsql);
                    $kiadquery = mysqli_query($conn, $kiadsql);

                    if (mysqli_num_rows($bevquery) > 0) {
                        if (mysqli_num_rows($kiadquery)<=0) {
                          echo (mysqli_fetch_assoc($bevquery)["sum"]*$Ar);
                        } else {
                            $bevmenny = mysqli_fetch_assoc($bevquery);
                            $kiadmenny = mysqli_fetch_assoc($kiadquery);
                            $szamol = $bevmenny["sum"]-$kiadmenny["sum"];
                            echo ($szamol*$Ar);
                        }
                    } else {
                        echo 0;
                    }
                }
                ?>
            </tbody>
    </div> <!-- adatbázishoz -->


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>

</html>