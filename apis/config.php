<?php

date_default_timezone_set('Asia/Calcutta');

try {

    $PDO = new PDO('mysql:host=localhost;dbname=underdogs', 'root', '');
//$PDO = new PDO('mysql:host=shareddb-f.hosting.stackcp.net;dbname=underdogs-3236a14e', 'underdogs-3236a14e', '9g6cuq3l1z');
} catch (PDOException $e) {
    print_r($e);
}
?>

