<?php
$upload = $_FILES['upload'];
$name = basename($upload['name']);
$uploadfile = "pictures/".$name;
if (strtolower(pathinfo($name)['extension']) != "jpeg") {
    http_response_code(400);
    echo "Only pictures allowed";
} else if (move_uploaded_file($upload['tmp_name'], $uploadfile)) {
    echo '"'.$name.'"';
} else {
    http_response_code(500);
    echo "Internal errpr";
}
?>