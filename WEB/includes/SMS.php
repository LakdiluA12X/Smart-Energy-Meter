<?php
// Installation

composer require shoutoutlabs/shoutout-sdk

// Usage

require __DIR__ . '/vendor/autoload.php';

use Swagger\Client\ShoutoutClient;

$apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIxYzIzMTBmMC1hZGVjLTExZWMtOTMyNi04ZDljOWY1Njk4MzkiLCJzdWIiOiJTSE9VVE9VVF9BUElfVVNFUiIsImlhdCI6MTY0ODM5OTAxMywiZXhwIjoxOTY0MDE4MjEzLCJzY29wZXMiOnsiYWN0aXZpdGllcyI6WyJyZWFkIiwid3JpdGUiXSwibWVzc2FnZXMiOlsicmVhZCIsIndyaXRlIl0sImNvbnRhY3RzIjpbInJlYWQiLCJ3cml0ZSJdfSwic29fdXNlcl9pZCI6IjY2Mzg4Iiwic29fdXNlcl9yb2xlIjoidXNlciIsInNvX3Byb2ZpbGUiOiJhbGwiLCJzb191c2VyX25hbWUiOiIiLCJzb19hcGlrZXkiOiJub25lIn0.0HbIxtt1u0RwOH3c6J-x5ZlROZLgWgD51KBj3HovZvs';

$client = new ShoutoutClient($apiKey,true,false);//(apikey,debug mode,ssl)



$message = array(
 'source' => 'ShoutDEMO',
  'destinations' => ['94779868792'],
 'content' => array(
  'sms' => 'Sent via ShoutOUT Gateway'
 ),
 'transports' => ['SMS']
);

try {
 $result = $client->sendMessage($message);
 print_r($result);
} catch (Exception $e) {
 echo 'Exception when sending message: ', $e->getMessage(), PHP_EOL;
}

?>