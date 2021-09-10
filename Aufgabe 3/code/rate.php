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

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

$client->putItem([
    "TableName" => "aws-kurs-db",
    "Item" => $marshaler->marshalItem($input)
]);

echo '{ "result": true }'
?>