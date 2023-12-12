<?php
include 'C:/Users/User/PhpstormProjects/Forms/Cards/Models/CardWithPhone.php';
function WorkWithCards($idata, $id, $action) : void
{
    //var_dump($idata);
    switch ($action) {
        case 'AddToFile':
            $newCard = new CardWithPhone(1, $idata["title"], $idata["text"], $idata["createdate"], $idata["phone"]);
            $data = JSONFile("C:/Users/User/PhpstormProjects/Forms/Cards/data.json", $newCard, "write");
            if (isset($idata["redstyle"]))
                $isred = true;
            else
                $isred = false;
            ViewCardsBootstrap($data, $isred);
            break;
        case 'DeleteFromFile':
            $data = JSONFile("C:/Users/User/PhpstormProjects/Forms/Cards/data.json", $id, "delete");
            if (isset($idata["redstyle"]))
                $isred = true;
            else
                $isred = false;
            ViewCards($data, $isred);
            break;
        case 'AddToSQLBase':
            $newCard = new CardWithPhone(1, $idata["title"], $idata["text"], $idata["createdate"], $idata["phone"]);
            if (WorkWithSQLBase($newCard, "insert")){
                if (isset($idata["redstyle"]))
                    $isred = true;
                else
                    $isred = false;
                ViewCardsBootstrap(WorkWithSQLBase("", "selectAll"), $isred);
            }
            break;
        case 'DeleteFromSQLBase':
            if (WorkWithSQLBase($id, "deleteById")) {
                if (isset($idata["redstyle"]))
                    $isred = true;
                else
                    $isred = false;
                ViewCardsBootstrap(WorkWithSQLBase("", "selectAll"), $isred);
            }
            break;
        case "UpdateSQLBase":
            $newCard = new CardWithPhone((int)$id, $idata["title"], $idata["text"], $idata["createdate"], $idata["phone"]);
            if (WorkWithSQLBase($newCard, "update")){
                if (isset($idata["redstyle"]))
                    $isred = true;
                else
                    $isred = false;
                ViewCardsBootstrap(WorkWithSQLBase("", "selectAll"), $isred);
            }
            break;
    }
}


function ViewCards($arr, $red) : void
{
    //var_dump($arr);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Form</title>
        <style>
            body{
            <?php
            if ($red)
                echo "background: #FDE6FCFF;";
            else
                echo "background: #e6f4fd;";
            ?>
            }
            .wrapper {
                display: grid;
                grid-template-columns: 25% 25% 25% 25%;
            }
            .wrapper div {
                text-align: center;
            <?php
            if ($red)
                echo "background: #f5a1ad;";
            else
                echo "background: #c7f8e0;";
            ?>
                box-shadow: 5px 3px 6px 3px rgb(128, 128, 128);
                margin: 10px;
                border: 1px solid #9d959d;
            }
            .card-header{
                text-align: center;
            }
            .controls{
                float: right;
            }
            .delete-card:hover{
                background: #1d7408;
            }
            .delete-card:not(:hover){
                border: 0;
                background-image: https://cdn.icon-icons.com/icons2/868/PNG/96/trash_bin_icon-icons.com_67981.png;
            <?php
            if ($red)
                echo "background: #f5a1ad;";
            else
                echo "background: #c7f8e0;";
            ?>
            }
            .correct-card:hover{
                background: #68cff8;
            }
            .correct-card:not(:hover){
                border: 0;
            <?php
            if ($red)
                echo "background: #f5a1ad;";
            else
                echo "background: #c7f8e0;";
            ?>
            }
            .title + input[type=text]:not(:focus) {
                border: 0;
                font-weight: bold;
                font-size: 19px;
                text-align: center;
            <?php
            if ($red)
                echo "background: #f5a1ad;";
            else
                echo "background: #c7f8e0;";
            ?>
            }
            input[type=text]:not(:focus) {
                border: 0;
                font-weight: bold;
                font-size: 19px;
                text-align: center;
                <?php
                if ($red)
                    echo "background: #f5a1ad;";
                else
                    echo "background: #c7f8e0;";
                ?>
                .card-inputs input[type=text]{
                    text-align: left;
                }
            }
        </style>
    </head>
    <body>
    <h1 class="card-header">My cards</h1>
        <div class='wrapper'>
            <?php
            foreach ($arr as $item){
                echo "<div class='card-head'>";
                echo "<form action='index.php' method='POST' class='delete'>";

                    echo "<span class='controls'>";
                        echo "<input name='CorrectCard' class='correct-card' type='submit' value='/'>";
                        echo "<input name='DeleteCard' class='delete-card' type='submit' value='X'>";
                    echo "</span>";

                    echo "<input name='ID' type='text' value='$item->id' hidden>";

                    echo "<span class='card-inputs'>";
                        echo "<p><input type='text' name='title' class='title' id='title$item->id' value='$item->title' readonly></p>";
                        echo "<p><b>Description:</b><input type='text' name='text' class='text' id='text$item->id' value='$item->text' readonly></p>";
                        echo "<p><b>Date:</b><input type='text' name='createdate' class='createdate' id='date$item->id' value='$item->createdate'></p>";
                        echo "<p><b>Phone:</b><input type='text' name='phone' class='phone' id='phone$item->id' value='$item->phone'></p>";
                    echo "</span>";

                echo "</div>";
                echo "</form>";
            }unset($item);
            ?>
        </div>

    </body>
    </html>
    <?php
}

//С использованием bootstrap
function ViewCardsBootstrap($arr, $red) : void
{
    //var_dump($arr);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Form</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <style>
            .card-header{
                text-align: center;
            }
            .delete-card:hover{
                background: #1d7408;
            }
            .delete-card:not(:hover){
                border: 0;
                background-image: https://cdn.icon-icons.com/icons2/868/PNG/96/trash_bin_icon-icons.com_67981.png;
            <?php
            if ($red)
                echo "background: #f5a1ad;";
            else
                echo "background: #c7f8e0;";
            ?>
            }
            .correct-card:hover{
                background: #3073fd;
            }
            .correct-card:not(:hover){
                border: 0;
            <?php
            if ($red)
                echo "background: #f5a1ad;";
            else
                echo "background: #c7f8e0;";
            ?>
            }
            .title + input[type=text]:not(:focus) {
                border: 0;
                font-weight: bold;
                font-size: 19px;
                text-align: center;
            <?php
            if ($red)
                echo "background: #f5a1ad;";
            else
                echo "background: #c7f8e0;";
            ?>
            }
            input[type=text]:not(:focus) {
                border: 0;
                /*font-weight: bold;*/
                font-size: 19px;
                text-align: center;
            <?php
            if ($red)
                echo "background: #f5a1ad;";
            else
                echo "background: #c7f8e0;";
            ?>
                .card-inputs input[type=text]{
                    text-align: left;
                }
            }
        </style>
    </head>
    <body class="bg-light">
    <h1 class="card-header">My cards</h1>
    <div class='container-fluid'>
        <div class="row ml-1">
        <?php
        foreach ($arr as $item){
            echo "<div class='w-24 bg-info border border-primary rounded shadow-lg pl-3 m-2'>";
            echo "<form action='index.php' method='POST' class='delete'>";

            echo "<button name='CorrectCard' class='btn ml-n3 btn-outline-info correct-card' type='submit'>";
                echo "<img src='https://cdn.icon-icons.com/icons2/1515/PNG/96/editdocument_105148.png' width='20' height='20' alt='correct' class='d-inline-block align-text-top'>";
            echo "</button>";
            echo "<button name='DeleteCard' class='btn ml-1 align-content-center delete-card' type='submit'>";
                echo "<img src='https://cdn.icon-icons.com/icons2/868/PNG/96/trash_bin_icon-icons.com_67981.png' width='20' height='20' alt='correct' class='d-inline-block align-text-top'>";
            echo "</button>";
            echo "<input name='ID' type='hidden' value='$item->id'>";
            echo "<span class='card-inputs'>";
            echo "<p><input type='text' name='title' class='bg-info text-center title' id='title$item->id' value='$item->title'></p>";
            echo "<p><b>Description:</b><input type='text' name='text' class='bg-info text' id='text$item->id' value='$item->text'></p>";
            echo "<p><b>Date:</b><input type='text' name='createdate' class='bg-info createdate' id='date$item->id' value='$item->createdate'></p>";
            echo "<p><b>Phone:</b><input type='text' name='phone' class='bg-info phone' id='phone$item->id' value='$item->phone'></p>";
            echo "</span>";
            echo "</div>";
            echo "</form>";
        }unset($item);
        ?>
        </div>
    </div>


    <!-- подключение фреймворка bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
}

function JSONFile($path, $idata, $action): mixed
{
    $data = [];
    if ($file = fopen($path, "r") or die("FAILURE")){
        switch ($action) {
            case "read":
                $data = json_decode(fread($file, filesize($path)));
            break;
            case "write";
                $data = json_decode(fread($file, filesize($path)));
                $data[] = $idata;
                fclose($file);
                $file = fopen($path, "w") or die("FAILURE");
                fwrite($file, json_encode($data));
            break;
            case "delete":
                $data = json_decode(fread($file, filesize($path)));
                $tmp=null;
                var_dump($data);
                echo "</br>";
                foreach ($data as $item=>$object){
                    if ($object->id==$idata)
                        unset($data[$item]);
                }
                $data = array_values($data);
                var_dump($data);
                echo "</br>";

//                if ($tmp!=null)
//                    $data = array_diff($data, (array)$tmp);
                fclose($file);
                $file = fopen($path, "w") or die("FAILURE");
                fwrite($file, json_encode($data));
            break;
        }
        fclose($file);
        return $data;
    }
}

function WorkWithSQLBase($idata, $action): mixed
{
    $server = "127.0.0.1";
    $database = "mycards";
    $username = "root";
    $password = "";

    $data = [];
    $conn = mysqli_connect($server, $username, $password, $database);
    if($conn) {
        switch ($action) {
            case "selectAll":
                $query = "SELECT * FROM `cards`;";
                $data = MappingSQLQuery($conn->query($query));
                break;
            case "selectById":
                $query = "SELECT * FROM `cards` WHERE Id = $idata;";
                if($conn->query($query) === true)
                    $data = MappingSQLQuery($conn->query($query));
                break;
            case "insert";
                $lastId = (int)$conn->query("SELECT Id FROM `cards` ORDER BY Id DESC LIMIT 1;")->fetch_assoc()["Id"];
                $query = "INSERT INTO `cards`(`Id`, `Title`, `Text`, `CreateDate`, `Phone`) VALUES ($lastId + 1,'$idata->title','$idata->text',$idata->createdate,'$idata->phone')";
                if($conn->query($query) === true)
                    $data = true;
                break;
            case "deleteById":
                $query = "DELETE FROM `cards` WHERE Id = $idata;";
                if($conn->query($query) === true)
                    $data = true;
                break;
            case "update":
                $query = "UPDATE `cards` SET `Title`='$idata->title',`Text`='$idata->text',`CreateDate`='$idata->createdate',`Phone`='$idata->phone' WHERE Id=$idata->id;";
                if($conn->query($query) === true)
                    $data = true;
                break;
        }
        mysqli_close($conn);
        return $data;
    }
    return false;
}

function MappingSQLQuery($Qresult) : mixed
{
    if ($Qresult->num_rows > 0) {
        // output data of each row
        while($row = $Qresult->fetch_assoc()) {
            $data[] = new CardWithPhone($row["Id"], $row["Title"], $row["Text"], $row["CreateDate"], $row["Phone"]);
        }
    }
    return $data;
}
