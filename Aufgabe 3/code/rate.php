<?php
require "config.php";

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

$client->putItem([
    "TableName" => $db_table,
    "Item" => $marshaler->marshalItem($input)
]);

echo '{ "result": true }'
?>