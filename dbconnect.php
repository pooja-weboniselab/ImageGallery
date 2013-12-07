<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 6/12/13
 * Time: 6:38 PM
 * To change this template use File | Settings | File Templates.
 */

$dbHost = "localhost";
$dbUser = "poojawebonise";
$dbPass = "weboniselab";
$dbName = "imagegallery_db";

/* connecting databases */
@mysql_connect($dbHost, $dbUser, $dbPass) or die("unable to
connect to database.");
mysql_select_db($dbName) or die ("Unable to select");
?>