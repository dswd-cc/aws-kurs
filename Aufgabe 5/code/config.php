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
$pictures_path = "pictures";
$db_table = "aws-kurs-db";
?>