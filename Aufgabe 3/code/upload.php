<?php
require 'vendor/autoload.php';
use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Marshaler;

$client = DynamoDbClient::factory([
    'profile' => 'default',
    'region'  => 'eu-central-1',
    'version' => 'latest'
]);
$marshaler = new Marshaler();

$upload = $_FILES['upload'];
$name = basename($upload['name']);
$uploadfile = "pictures/".$name;
if (strtolower(pathinfo($name)['extension']) != "jpeg") {
    http_response_code(400);
    echo "Only pictures allowed";
} else if (move_uploaded_file($upload['tmp_name'], $uploadfile)) {
    $client->putItem([
        "TableName" => "aws-kurs-db",
        "Item" => $marshaler->marshalItem(["file" => $name, "rating" => 0])
    ]);
    echo '"'.$name.'"';
} else {
    http_response_code(500);
    echo "Internal errpr";
}
?>