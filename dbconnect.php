<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 6/12/13
 * Time: 6:38 PM
 * To change this template use File | Settings | File Templates.
 */

$dbHost = "localhost";
$dbName = "imagegallery_db";
$dbUser = "poojawebonise";
$dbPass = "weboniselab";

/*
/* connecting databases
@mysql_connect($dbHost, $dbUser, $dbPass) or die("unable to
connect to database.");
mysql_select_db($dbName) or die ("Unable to select");
*/

try {
    $conn = new PDO('mysql:host=localhost;dbname=$dbName', $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

?>