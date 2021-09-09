<?php
$upload = $_FILES['upload'];
$name = basename($upload['name']);
$uploadfile = "pictures/".$name;
if (move_uploaded_file($upload['tmp_name'], $uploadfile)) {
    echo '"'.$name.'"';
} else {
    http_response_code(500);
}
?>