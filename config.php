<?php
require 'vendor/autoload.php'; // MongoDB PHP library

$client = new MongoDB\Client("mongodb://localhost:27017");
$db = $client->musicdb;
$songsCollection = $db->songs;
