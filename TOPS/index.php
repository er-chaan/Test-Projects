<?php
    $screen = "1";
    $msg = "";
    if(isset($_GET["screen"])){
        $screen = $_GET["screen"];
    }
    if(isset($_GET["msg"])){
        $msg = $_GET["msg"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product details - field mapper integration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function(){
        var screen = "<?php echo $screen;?>";
        $("#screen_1").hide();
        $("#screen_2").hide();
        $("#screen_3").hide();
        $("#screen_"+screen+"").show();
    });
  </script>
</head>
<body>
<div class="container">
    <h2>Product details - field mapper integration</h2>
    <?php
        if($msg){
            echo '<div class="alert alert-dark" role="alert">
                '.$msg.'
            </div>';
        }
    ?>
    <div id="screen_1">
        <hr>
            <h4>Screen 1</h4>
            <form action="fileToTemp.php" method="post" enctype='multipart/form-data' autocomplete="off">
                <div class="form-group">
                    <label for="fileToUpload">file input</label>
                    <input type="file" class="form-control-file" id="fileToUpload" name="fileToUpload" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        <hr>
    </div>
    <div id="screen_2">
        <hr>
            <h4>Screen 2</h4>
            <?php
                $filename = "imports/Temp.csv";
                $file = fopen($filename, "r");
                $csv_headers = fgetcsv($file, 10000, ",");
            ?>
            <form action="fieldMap.php" method="post" autocomplete="off">
                <table class="table-sm">
                    <thead>
                        <tr>
                            <th scope="col">System Fields</th>
                            <th scope="col">Excel/CSV Import Fields</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $system_fields = array("title","SKU","description","price","quantity","category");
                            foreach ($system_fields as $key => $value) {
                                echo "<tr><td>".$value."</td><td>";
                                echo '<div class="form-group"><select class="custom-select" name="'.$value.'" required>';
                                echo "<option selected></option>";
                                foreach ($csv_headers as $key1 => $value1) {
                                    echo '<option value="'.$value1.'">'.$value1.'</option>';
                                }
                                echo "</select></div></td></tr>";
                            }
                        ?>
                    </tbody>
                </table>                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        <hr>
    </div>
    <div id="screen_3">
        <hr>
            <h4>Screen 3</h4>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>title</th>
                        <th>SKU</th>
                        <th>description</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once "database.php";
                        $sql = "SELECT * FROM ProductModule";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row["title"]."</td><td>".$row["SKU"]."</td><td>".$row["description"]."</td>
                                    <td>".$row["price"]."</td><td>".$row["quantity"]."</td>";
                                $sql1 = "SELECT cid FROM MappingProductCategory WHERE pid=".$row["id"]."";
                                $result1 = $conn->query($sql1);
                                $category = "";
                                while($row1 = $result1->fetch_assoc()) {
                                    $row1["cid"];
                                    $sql1 = "SELECT cid FROM MappingProductCategory WHERE pid=".$row["id"]."";
                                    $result1 = $conn->query($sql1);
                                    $category = "";
                                    while($row1 = $result1->fetch_assoc()) {
                                        $row1["cid"];
                                    }
                                }
                                $sql1 = "SELECT * FROM CategoryModule where id IN 
                                    (SELECT cid FROM MappingProductCategory WHERE pid=".$row["id"].")";
                                $result1 = $conn->query($sql1);
                                $category = "";
                                while($row1 = $result1->fetch_assoc()) {
                                    $category .= $row1["title"]." | ";
                                }
                                echo "<td>".$category."</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan=6>0 Data</td></tr>";
                        }
                        $conn->close();
                    ?>
                </tbody>
            </table>
        <hr>
    </div>
</div>
</body>
</html>