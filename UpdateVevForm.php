<?php
include "header.php";
include "connection.php";
include "head.php";
$id = $_GET["id"];

$sql_l = "SELECT * FROM vevo WHERE ID=" . $id;
$records_act = mysqli_query($conn, $sql_l);
$row_act = mysqli_fetch_row($records_act);

$Nev = $row_act[1];
$Cim = $row_act[2];
$Telefon = $row_act[3];
?>

<script type="text/javascript">
    telefonBe = () => {
        var szam = document.getElementById("InputTelefon").value;
        var regex = new RegExp("^[\+]?[(]?[0-9]{4}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4}$")
        if (!regex.test(szam)) {
            document.getElementById("updateVevBtn").disabled = true;
        } else {
            document.getElementById("updateVevBtn").disabled = false;
        }
        console.log(document.getElementById("InputTelefon").value);
    }
</script>

<body>
    <div class="w-auto">
        <!-- idejöhet a form -->
        <form action="vevUpdate.php" method="post">
            <div id="errorShowDiv"></div>
            <div>
                <div class="mid" style="font-size: 30px;">Termék/szolgáltatás módosítás </div><br>
                <!-- név -->
                <div>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class=" input-group input-group-sm mb-3 inputField">
                        <span class="input-group-text" id="inputGroup-sizing-s">Név</span>
                        <input id="Név" name="Nev" type="text" value="<?php echo $Nev ?>" class="form-control" onchange="submitSetEnable()" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                    <div class="input-group input-group-sm mb-3 inputField">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Cím</span>
                        <input id="Cím" name="Cim" type="text" value="<?php echo $Cim ?>" class="form-control" onchange="submitSetEnable()" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                    <div class="input-group input-group-sm mb-3 inputField">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Telefonszám</span>
                        <input id="InputTelefon" name="Telefon" onchange="telefonBe()" type="tel" value="<?php echo $Telefon ?>" class="form-control" onchange="submitSetEnable()" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                </div>
                <br>
                <!-- gombok -->
                <div class="mid">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <button id="updateVevBtn" type="submit" class="btn btn-primary">Mentés</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=./Vevok.php id="megseBtn" type="reset" class="btn btn-primary">Mégse</a>
                    <!-- gombok -->
                    <br>
                </div>
            </div>
        </form>
        <!-- form vége -->
    </div>
</body>