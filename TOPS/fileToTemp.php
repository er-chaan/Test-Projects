<?php
    $target_dir = "imports/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $target_file = $target_dir ."Temp" . '.' . $ext;
    @unlink($target_file);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 0;
            $msg = "File is an image - " . $check["mime"] . ".";
            $screen = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 1;
            $msg = "File is not an image.";
            $screen = 2;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        $msg = "Sorry, file already exists.";
        $screen = 1;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        $msg = "Sorry, your file is too large.";
        $screen = 1;
    }
    // Allow certain file formats
    if($imageFileType != "csv") {
        echo "Sorry, only CSV allowed.";
        $uploadOk = 0;
        $msg = "Sorry, only CSV allowed.";
        $screen = 1;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        $msg = "Sorry, your file was not uploaded.";
        $screen = 1;
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $msg = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $screen = 2;
        } else {
            echo "Sorry, there was an error uploading your file.";
            $msg = "Sorry, there was an error uploading your file.";
            $screen = 1;
        }
    }
    header("Location:index.php?screen=".$screen."&&msg=".$msg."");
?>