<!DOCTYPE html>
<html lang="en">
<?php include_once "header.php";
include_once "head.php";
include_once "connection.php";
?>

<script type="text/javascript">
    telefonBe = () => {
        var szam = document.getElementById("InputTelefon").value;
        var regex = new RegExp("^[\+]?[(]?[0-9]{4}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4}$")
        if (!regex.test(szam)) {
            document.getElementById("HozzaAd").disabled = true;
        } else {
            document.getElementById("HozzaAd").disabled = false;
        }
        console.log(document.getElementById("InputTelefon").value);
    }
</script>

<body>
    <div class="container-fluid">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-row">
            <div class="col-1">Vevők</div>
                <div class="col-2">
                    <input type="text" class="form-control" id="InputNev" placeholder="Név" name="InputNev">
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" id="InputCim" placeholder="Cím" name="InputCim">
                </div>
                <div class="col-3">
                    <input type="tel" class="form-control" id="InputTelefon" placeholder="Telefonszám" name="InputTelefon" onchange="telefonBe()">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary" id="HozzaAd">Hozzáad</button>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $sql = "SELECT MAX(ID) FROM vevo";
                        $records = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($records) < 0) {
                            $ID = 1;
                        } else {
                            $row = mysqli_fetch_row($records);
                            $ID = $row[0] + 1;
                        }
                        $sqlInsert = "INSERT INTO vevo (ID, Név, Cim, Telefon) VALUES (?,?,?,?)";
                        $Nev =  $_POST["InputNev"];
                        $Cim =  $_POST["InputCim"];
                        $Telefon =  $_POST["InputTelefon"];

                        if ($stmt = mysqli_prepare($conn, $sqlInsert)) {
                            mysqli_stmt_bind_param($stmt, "isss", $param_ID, $param_Nev, $param_Cim, $param_Telefon);
                            $param_ID = (int)$ID;
                            $param_Nev = $Nev;
                            $param_Cim = $Cim;
                            $param_Telefon = $Telefon;
                            // if (mysqli_stmt_execute($stmt)) {
                            //     echo "megy";
                            // }else {
                            //     echo "nem megy";
                            // }
                            $stmt->execute();
                            $param_ID = null;
                            $param_Nev = null;
                            $param_Cim = null;
                            $param_Telefon = null;
                            mysqli_stmt_close($stmt);
                        }
                        //mysqli_close($conn);
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
                    <th>Név</th>
                    <th>Cím</th>
                    <th>Telefonszám</th>
                    <th>Módosít</th>
                    <th>Töröl</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM vevo";
                $records = mysqli_query($conn, $sql);


                if (mysqli_num_rows($records) > 0) {
                    while ($row = mysqli_fetch_assoc($records)) {
                        echo '<tr>',
                        '<td>', $row["ID"], '</td>',
                        '<td>', $row["Név"], '</td>',
                        '<td>', $row["Cim"], '</td>',
                        '<td>', $row["Telefon"], '</td>',
                        '<td><a href="UpdateVevForm.php?id=' . $row["ID"] . '" class="btn btn-primary btn-sm max">Módosítás</a></td>',
                        '<td><a href="deleteVev.php?id=' . $row["ID"] . '" class="btn btn-danger btn-sm max">Törlés</a></td>',
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