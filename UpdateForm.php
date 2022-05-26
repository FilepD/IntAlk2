<?php
include "header.php";
include "connection.php";
include "head.php";
$id = $_GET["id"];

$sql_l = "SELECT * FROM termszolg WHERE ID=" . $id;
$records_act = mysqli_query($conn, $sql_l);
$row_act = mysqli_fetch_row($records_act);

$Nev = $row_act[1];
$Ar = $row_act[2];
$Leiras = $row_act[3];
?>

<body>
    <div class="w-auto">
        <!-- idejöhet a form -->
        <form action="tszUpdate.php" method="post">
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
                        <span class="input-group-text" id="inputGroup-sizing-sm">Ár</span>
                        <input id="Ár" name="Ar" type="text" value="<?php echo $Ar ?>" class="form-control" onchange="submitSetEnable()" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                    <div class="input-group input-group-sm mb-3 inputField">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Leírás</span>
                        <input id="Leírás" name="Leiras" type="text" value="<?php echo $Leiras ?>" class="form-control" onchange="submitSetEnable()" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                </div>
                <br>
                <!-- gombok -->
                <div class="mid">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <button id="updateBtn" type="submit" class="btn btn-primary">Mentés</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button id="megseBtn" type="reset" class="btn btn-primary">Mégse</button>
                    <!-- gombok -->
                    <br>
                </div>
            </div>
        </form>
        <!-- form vége -->
    </div>
</body>