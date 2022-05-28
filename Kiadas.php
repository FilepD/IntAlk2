<!DOCTYPE html>
<html lang="en">
<?php include_once "header.php";
include_once "head.php";
include_once "connection.php";
?>

<body>
    <div class="container-fluid">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-row">
            <div class="col-1">Kiadás</div>
                <div class="col-2">
                    <input type="number" min="1" class="form-control" id="InputVevoID" placeholder="Vevo ID" name="InputVevoID">
                </div>
                <div class="col-2">
                    <input type="number" min="1" class="form-control" id="InputTermszolgID" placeholder="Termék/szolgáltatás ID" name="InputTermszolgID">
                </div>
                <div class="col-3">
                    <input type="number" min="1" class="form-control" id="InputMennyiseg" placeholder="Mennyiség" name="InputMennyiseg">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary" id="HozzaAd">Hozzáad</button>
                    <?php
                    try {
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $sql = "SELECT MAX(ID) FROM kiadas";
                            $records = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($records) < 0) {
                                $ID = 1;
                            } else {
                                $row = mysqli_fetch_row($records);
                                $ID = $row[0] + 1;
                            }
                            $sqlInsert = "INSERT INTO kiadas (ID, VevoID, TermszolgID, Mennyiség) VALUES (?,?,?,?)";
                            $VevoID =  $_POST["InputVevoID"];
                            $TermSzolgID = $_POST["InputTermszolgID"];
                            $Mennyiseg =  $_POST["InputMennyiseg"];

                            // mennyiség ellenőrzés
                            $eldont = false;
                            $ertek = 0;
                            $bevsql = "SELECT SUM(Mennyiség) as sum FROM bevetelezes WHERE TermSzolgID =" . $TermSzolgID;
                            $kiadsql = "SELECT SUM(Mennyiség) as sum FROM kiadas WHERE TermSzolgID =" . $TermSzolgID;
                            $bevquery = mysqli_query($conn, $bevsql);
                            $kiadquery = mysqli_query($conn, $kiadsql);

                            if (mysqli_num_rows($bevquery) > 0) {
                                if (mysqli_num_rows($kiadquery) <= 0) {
                                    $eldont = true;
                                    $ertek = mysqli_fetch_assoc($bevquery)["sum"];
                                } else {
                                    $bevmenny = mysqli_fetch_assoc($bevquery);
                                    $kiadmenny = mysqli_fetch_assoc($kiadquery);
                                    $ertek = $bevmenny["sum"] - $kiadmenny["sum"];
                                    $eldont = true;
                                }
                            } else {
                                $eldont = false;
                                $ertek = 0;
                            }
                            if ($eldont) {
                                $ertek = $ertek - $Mennyiseg;
                            }
                            //gomb funkció
                            if ($ertek >= 0) {
                                if ($stmt = mysqli_prepare($conn, $sqlInsert)) {
                                    mysqli_stmt_bind_param($stmt, "iiii", $param_ID, $param_VevoID, $param_TermSzolgID, $param_Mennyiseg);
                                    $param_ID = (int)$ID;
                                    $param_VevoID = (int)$VevoID;
                                    $param_TermSzolgID = (int)$TermSzolgID;
                                    $param_Mennyiseg = (int)$Mennyiseg;
                                    // if (mysqli_stmt_execute($stmt)) {
                                    //     echo "megy";
                                    // }else {
                                    //     echo "nem megy";
                                    // }
                                    $stmt->execute();
                                    $param_ID = null;
                                    $param_VevoID = null;
                                    $param_TermSzolgID = null;
                                    $param_Mennyiseg = null;
                                    mysqli_stmt_close($stmt);
                                }
                                //mysqli_close($conn);
                            } else {
                                echo '<script type="text/javascript">
                                alert("Nincs elég termék, hogy kiadhass!");
                                </script>';
                            }
                        }
                    } catch (Exception $e) {
                        echo '<script type="text/javascript">
                    alert("Nem létező Termék/Szolgáltatás ID vagy Beszállító ID");
                    </script>';
                    }
                    ?>
                </div>
            </div>
        </form>
    </div> <!-- formnak -->
    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vevő ID</th>
                    <th>Termék/szolgáltatás ID</th>
                    <th>Mennyiség</th>
                    <th>Módosít</th>
                    <th>Töröl</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM kiadas";
                $records = mysqli_query($conn, $sql);


                if (mysqli_num_rows($records) > 0) {
                    while ($row = mysqli_fetch_assoc($records)) {
                        echo '<tr>',
                        '<td>', $row["ID"], '</td>',
                        '<td>', $row["VevoID"], '</td>',
                        '<td>', $row["TermSzolgID"], '</td>',
                        '<td>', $row["Mennyiség"], '</td>',
                        '<td><a href="UpdateKiadForm.php? id=' . $row["ID"] . '" class="btn btn-primary btn-sm max">Módosítás</a></td>',
                        '<td><a href="deleteKiad.php? id=' . $row["ID"] . '" class="btn btn-danger btn-sm max">Törlés</a></td>',
                        '</tr>';
                    }
                } else {
                    echo "0 results ";
                }

                ?>
            </tbody>
    </div> <!-- adatbázishoz -->


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>

</html>