<?php

session_start();

include './persistencia/Conexao.php';
include './_class/Update.php';
include './_class/Insert.php';


$tmpString = $_POST['tmpCod'];
$target_dir = "uploads/";
//$name_file = explode('.', basename($_FILES["fileToUpload"]["name"])); // NÃO TIRAVA OS CARACTERES ESPECIAIS POR ISSO IMPLEMENTEI A LINHA DE BAIXO 
$name_file = explode('.', basename(preg_replace("/[^\w\s]/", "", iconv("UTF-8", "ASCII//TRANSLIT", $_FILES["fileToUpload"]["name"]))));
$name_file = str_replace(" ", "", $name_file);
$name_file = str_replace("  ", "", $name_file);
$name_original = basename($_FILES["fileToUpload"]["name"]);
$name_original = str_replace(" ", "", $name_original);
$name_original = str_replace("  ", "", $name_original);
$target_file = $target_dir . $name_file[0] . date("H:i:s");
$target_file = str_replace(':', '', $target_file);
$target_file_session = str_replace(':', '', $name_file[0] . date("H:i:s"));
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($name_original, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file . '.pdf')) {

        $_SESSION['name_image'] = $target_file_session . '.pdf';
        $url = $target_file_session . '.pdf';
        //header('Location: cadastro_material.php');
        //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        
        $id_anexo = Insert::cadastrar_url($url, $tmpString);
        $return = Update::usuario_url_vacina($tmpString, $id_anexo);

        if ($return == '001') {
            header('Location: /vacinabbtt/animation.php');

        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}