<?php
    session_start();
    require_once "../util/dbManager.php"; //includes Database Class
    require_once "../util/sessionUtil.php"; //includes session util functions

    $userId = isLogged();
    if($userId === false){
        header("location: ../../index.php");
    }
    $errorMessage;

    // Check the format
    if(isset($_POST["submit"])) {

        $fileName = $_FILES["image"]["name"];
        $fileTmpName = $_FILES["image"]["tmp_name"];
        $fileSize = $_FILES["image"]["size"];
        $fileError = $_FILES["image"]["error"];
        $fileType = $_FILES["image"]["type"];

        $ext = explode(".", $fileName);
        $fileExt = strtolower(end($ext));

        $allowed = array("jpg", "jpeg", "png");
        if(in_array($fileExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 500000){
                    $fileNewName = "profile" . $userId . "." . $fileExt;
                    $fileDest = "../../img/profilePics/".$fileNewName;
                    move_uploaded_file($fileTmpName, $fileDest);
                    $res = loadImage($fileNewName, $userId);
                    if($res === true){
                        $errorMessage = "Your profile picture was uploaded!";
                    } else {
                        $errorMessage = "An error occurred, try again later";
                    }
                    header("location: ./userProfile.php? $errorMessage");
                } else {
                    $errorMessage = "File is too big!";
                    header("location: ./userProfile.php? $errorMessage");
                }
            } 
        } else {
            $errorMessage = "File extention not allowed";
            header("location: ./userProfile.php? $errorMessage");
        }
    }
            

    function loadImage($fileDest, $userId){
        global $DB;
        $query = 'UPDATE user SET profilePic = \'' . $fileDest . '\' WHERE userId = \'' . $userId . '\'';
        $updated = $DB->performQuery($query);
        if ($updated === FALSE){
            return false;
        } else {
            return true;
        }
    }
?>
