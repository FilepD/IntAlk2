<?php
include "header.php";
include "connection.php";
include "head.php";
$id = $_GET["id"];

$sql_l = "SELECT * FROM bevetelezes WHERE ID=" . $id;
$records_act = mysqli_query($conn, $sql_l);
$row_act = mysqli_fetch_row($records_act);

$BeszallitoID = $row_act[1];
$TermSzolgID = $row_act[2];
$Mennyiség = $row_act[3];
?>

<body>
    <div class="w-auto">
        <!-- idejöhet a form -->
        <form action="bevUpdate.php" method="post">
            <div id="errorShowDiv"></div>
            <div>
                <div class="mid" style="font-size: 30px;">Termék/szolgáltatás módosítás </div><br>
                <!-- név -->
                <div>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class=" input-group input-group-sm mb-3 inputField">
                        <span class="input-group-text" id="inputGroup-sizing-s">Beszállító ID</span>
                        <input id="BeszallitoID" name="BeszallitoID" type="text"  value="<?php echo $BeszallitoID ?>
                        " class="form-control" onchange="submitSetEnable()" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                    <div class="input-group input-group-sm mb-3 inputField">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Termék/szolgáltatás ID</span>
                        <input id="TermSzolgID" name="TermSzolgID" type="text" value="<?php echo $TermSzolgID ?>
                        " class="form-control" onchange="submitSetEnable()" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                    <div class="input-group input-group-sm mb-3 inputField">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Mennyiség</span>
                        <input id="Mennyiség" name="Mennyiség" type="text" value="<?php echo $Mennyiség ?>
                        " class="form-control" onchange="submitSetEnable()" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                </div>
                <br>
                <!-- gombok -->
                <div class="mid">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <button id="updateBevBtn" type="submit" class="btn btn-primary">Mentés</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=./Bevetelezes.php id="megseBtn" type="reset" class="btn btn-primary">Mégse</a>
                    <!-- gombok -->
                    <br>
                </div>
            </div>
        </form>
        <!-- form vége -->
    </div>
</body>