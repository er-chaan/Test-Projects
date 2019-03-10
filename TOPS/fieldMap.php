<?php
    require_once "database.php";
    $filename = "imports/Temp.csv";
    $file = fopen($filename, "r");
    $getDataX = fgetcsv($file, 10000, ",");
    $rows = 0;
    $cols = 0;
    $csvarray = array();
    if (($handle = fopen($filename, "r")) !== FALSE) {
        $rows = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $cols = count($data);
            for ($c=0;$c<$cols;$c++)
            {
                $csvarray[$rows][$c] = $data[$c];
            }
            $rows++;
        }
        fclose($handle);
    }
    $title_col = array_search($_POST['title'], $csvarray[0]);
    $SKU_col = array_search($_POST['SKU'], $csvarray[0]);
    $description_col = array_search($_POST['description'], $csvarray[0]);
    $price_col = array_search($_POST['price'], $csvarray[0]);
    $quantity_col = array_search($_POST['quantity'], $csvarray[0]);
    $category_col = array_search($_POST['category'], $csvarray[0]);

    for ($i=1; $i < count($csvarray); $i++) {
        $title =  $csvarray[$i][$title_col];
        $SKU =  $csvarray[$i][$SKU_col];
        $description =  $csvarray[$i][$description_col];
        $price =  $csvarray[$i][$price_col];
        $quantity =  $csvarray[$i][$quantity_col];
        $category =  $csvarray[$i][$category_col];
        $last_id = 0;
        $sql = "SELECT id,SKU FROM `ProductModule` where SKU='".$SKU."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
            }
            $sql = "UPDATE `ProductModule` SET title='".$title."', SKU='".$SKU."', description='".$description."', 
                    price=".$price.", quantity=".$quantity." WHERE id=".$id."";
            $conn->query($sql);
        } else {
            $sql = "INSERT INTO `ProductModule` (`title`, `SKU`, `description`, `price`, `quantity`) 
                VALUES ('".$title."', '".$SKU."', '".$description."', ".$price.", ".$quantity.")";
            $conn->query($sql);
            $last_id = $conn->insert_id;
        }
        $category = explode("|",$category);
        foreach ($category as $key => $value) {
            $sql = "SELECT id,title FROM `CategoryModule` where title='".$value."'";
            $result = $conn->query($sql);
            if (!$result->num_rows) {
                $sql = "INSERT INTO `CategoryModule` (`title`) VALUES ('".$value."')";
                $conn->query($sql);
                $cid = $conn->insert_id;
            }
            if($last_id>0)
            {
                while($row = $result->fetch_assoc()) {
                    $cid = $row["id"];
                }
                $sql = "INSERT INTO `MappingProductCategory` (`pid`,`cid`) VALUES (".$last_id.",".$cid.")";
                $conn->query($sql);   
            }
        }
    }
    $conn->close();
    $msg = "Mapping succesfully done.";
    $screen = 3;
    header("Location:index.php?screen=".$screen."&&msg=".$msg."");
?>